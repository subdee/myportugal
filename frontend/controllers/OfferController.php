<?php
namespace frontend\controllers;

use common\models\Booking;
use common\models\Offer;
use frontend\components\Paypal;
use frontend\models\BookingForm;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use Yii;
use yii\helpers\Url;
use yii\log\Logger;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OfferController extends Controller
{
    public function actionIndex($slug)
    {
        $offer = Offer::findOne(['slug' => $slug]);
        if (!$offer) {
            throw new NotFoundHttpException(Yii::t('app', 'This offer does not exist'));
        }

        return $this->render('index', ['offer' => $offer]);
    }

    public function actionBook($slug)
    {
        /** @var Offer|null */
        $offer = Offer::findOne(['slug' => $slug]);
        if (!$offer) {
            throw new NotFoundHttpException(Yii::t('app', 'This offer does not exist'));
        }

        $model = new BookingForm();
        $model->newsletter = true;
        $booking = $model->save($offer);

        if ($model->load(Yii::$app->request->post()) && $booking !== false) {
            Yii::$app->session->setFlash('success', [
                'type' => Growl::TYPE_SUCCESS,
                'icon' => 'fa fa-check',
                'title' => Yii::t('app', 'Booking successful'),
                'message' => Yii::t('app',
                    'Thank you for your booking {name}. You will be contacted by our agents for further details.', [
                        'name' => $model->firstName,
                    ]),
            ]);
            $this->createPayment($booking);
        }

        return $this->render('book', ['offer' => $offer, 'model' => $model]);
    }

    private function createPayment(Booking $booking)
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item = new Item();
        $item->setName(Yii::t('app', 'Booking for {offer}', ['offer' => $booking->offer->title]))
            ->setCurrency(Yii::$app->formatter->currencyCode)
            ->setQuantity(1)
            ->setSku((string)$booking->_id)
            ->setPrice($booking->offer->price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency(Yii::$app->formatter->currencyCode)
            ->setTotal($booking->offer->price);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Payment for booking ' . (string)$booking->_id)
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(Url::to(['offer/afterPayment', 'success' => 1], true))
            ->setCancelUrl(Url::to(['offer/afterPayment', 'success' => 0], true));

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            /** @var Paypal $paypal */
            $paypal = Yii::$app->paypal;
            $payment->create($paypal->getContext());
        } catch (\Exception $ex) {
            Yii::$app->log->logger->log('Paypal initialization failed', Logger::LEVEL_ERROR);
            return false;
        }

        $approvalUrl = $payment->getApprovalLink();
        return $this->redirect($approvalUrl);
    }
}
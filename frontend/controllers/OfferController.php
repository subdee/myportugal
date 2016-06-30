<?php
namespace frontend\controllers;

use common\models\Booking;
use common\models\Offer;
use frontend\components\Paypal;
use frontend\models\BookingForm;
use frontend\models\TravelSearchForm;
use kartik\widgets\Growl;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
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

        if ($model->load(Yii::$app->request->post()) &&
            ($booking = $model->save($offer)) !== false &&
            $this->createPayment($booking) === false
        ) {
            Yii::$app->session->setFlash('error', [
                'type' => Growl::TYPE_DANGER,
                'icon' => 'fa fa-ban',
                'title' => Yii::t('app', 'Payment creation failed'),
                'message' => Yii::t(
                    'app',
                    'There was a problem generating a payment for you. Please try again or contact customer support for assistance'
                ),
            ]);
        }

        return $this->render('book', ['offer' => $offer, 'model' => $model]);
    }

    public function actionAfterPayment($success)
    {
        try {
            if (!$success) {
                throw new \Exception('Paypal success was false');
            }

            /** @var Paypal $paypal */
            $paypal = Yii::$app->paypal;

            $paymentId = Yii::$app->request->get('paymentId');
            $payment = Payment::get($paymentId, $paypal->getContext());

            $booking = Booking::findOne($payment->getTransactions()[0]->getInvoiceNumber());
            if (!$booking) {
                return $this->redirect(['site/index']);
            }

            $execution = new PaymentExecution();
            $execution->setPayerId(Yii::$app->request->get('PayerID'));
            $payment->execute($execution, $paypal->getContext());
            $payment = Payment::get($paymentId, $paypal->getContext());

            $saleState = $payment->getTransactions()[0]->getRelatedResources()[0]->getSale()->getState();
            if ($saleState !== 'completed') {
                throw new \Exception('Paypal sale state is ' . $saleState);
            }

            $booking->completedOn = time();
            $booking->status = Booking::STATUS_PAID;

            Yii::$app->session->setFlash('success', [
                'type' => Growl::TYPE_SUCCESS,
                'icon' => 'fa fa-check',
                'title' => Yii::t('app', 'Payment succeeded'),
                'message' => Yii::t(
                    'app',
                    'Thank you, {name}. Your booking is completed! One of our agents will contact you soon for the details.',
                    ['name' => $booking->firstName]
                ),
            ]);
        } catch (\Exception $e) {
            Yii::$app->log->logger->log('Paypal initialization failed: ' . $e->getMessage(), Logger::LEVEL_ERROR);
            Yii::$app->session->setFlash('error', [
                'type' => Growl::TYPE_DANGER,
                'icon' => 'fa fa-ban',
                'title' => Yii::t('app', 'Payment failed'),
                'message' => Yii::t(
                    'app',
                    'Your payment failed. Please try booking again or contact customer support for further assistance.'
                ),
            ]);
            $booking->status = Booking::STATUS_FAILED;
        }

        $booking->save(false);

        return $this->redirect(['site/index']);
    }

    public function actionSearch()
    {
        $travelSearch = new TravelSearchForm();
        $offers = [];

        if ($travelSearch->load(Yii::$app->request->post())) {
            $offers = Offer::find()->bySearchForm($travelSearch)->all();
        }

        return $this->render('search', ['offers' => $offers]);
    }

    private function createPayment(Booking $booking)
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item = new Item();
        $item->setName(Yii::t('app', 'Booking {n,plural,=1{1 adult} other{# adults}} for {offer}', [
            'n' => $booking->adults,
            'offer' => $booking->offer->title
        ]))
            ->setCurrency(Yii::$app->formatter->currencyCode)
            ->setQuantity($booking->adults)
            ->setPrice($booking->offer->price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency(Yii::$app->formatter->currencyCode)
            ->setTotal($booking->offer->price * $booking->adults);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Payment for booking ' . (string)$booking->_id)
            ->setInvoiceNumber((string)$booking->_id);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(Url::to(['offer/after-payment', 'success' => 1], true))
            ->setCancelUrl(Url::to(['offer/after-payment', 'success' => 0], true));

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        $booking->payment = (object)[
            'invoice_number' => $transaction->getInvoiceNumber(),
            'amount' => $transaction->getAmount()->getTotal(),
        ];
        $booking->save(false);

        try {
            /** @var Paypal $paypal */
            $paypal = Yii::$app->paypal;
            $payment->create($paypal->getContext());
        } catch (\Exception $e) {
            Yii::$app->log->logger->log('Paypal initialization failed: ' . $e->getMessage(), Logger::LEVEL_ERROR);

            return false;
        }

        $approvalUrl = $payment->getApprovalLink();

        return $this->redirect($approvalUrl);
    }
}
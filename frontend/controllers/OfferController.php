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
use yii\web\Controller;
use yii\web\HttpException;
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
            ($booking = $model->save($offer)) !== false
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

    public function actionSearch()
    {
        $travelSearch = new TravelSearchForm();
        $offers = [];

        if ($travelSearch->load(Yii::$app->request->post())) {
            $offers = Offer::find()->bySearchForm($travelSearch)->all();
        }

        return $this->render('search', ['offers' => $offers]);
    }
}
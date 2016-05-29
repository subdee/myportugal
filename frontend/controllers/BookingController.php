<?php
namespace frontend\controllers;

use common\models\Booking;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BookingController extends Controller
{
    public function actionIndex($slug)
    {
        $booking = Booking::findOne(['slug' => $slug]);
        if ( ! $booking) {
            throw new NotFoundHttpException(Yii::t('app', 'This booking does not exist'));
        }

        return $this->render('index', ['booking' => $booking]);
    }

    public function actionBook($slug)
    {
        
    }
}
<?php
namespace frontend\controllers;

use common\models\Offer;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OfferController extends Controller
{
    public function actionIndex($slug)
    {
        $offer = Offer::findOne(['slug' => $slug]);
        if ( ! $offer) {
            throw new NotFoundHttpException(Yii::t('app', 'This offer does not exist'));
        }

        return $this->render('index', ['offer' => $offer]);
    }

    public function actionBook($slug)
    {
        $offer = Offer::findOne(['slug' => $slug]);
        if ( ! $offer) {
            throw new NotFoundHttpException(Yii::t('app', 'This offer does not exist'));
        }

        return $this->render('book', ['offer' => $offer]);
    }
}
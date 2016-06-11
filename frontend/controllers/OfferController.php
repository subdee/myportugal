<?php
namespace frontend\controllers;

use common\models\Offer;
use frontend\models\BookingForm;
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

        $model = new BookingForm();
        $model->newsletter = true;

        if ($model->load(Yii::$app->request->post()) && $model->save($offer)) {
            $this->redirect(['site/index']);
        }

        return $this->render('book', ['offer' => $offer, 'model' => $model]);
    }
}
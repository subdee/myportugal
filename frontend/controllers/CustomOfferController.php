<?php
namespace frontend\controllers;

use common\models\CustomOffer;
use kartik\widgets\Growl;
use Yii;
use yii\web\Controller;

class CustomOfferController extends Controller
{
    public function actionIndex()
    {
        $model = new CustomOffer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', [
                'type' => Growl::TYPE_SUCCESS,
                'icon' => 'fa fa-check',
                'message' => Yii::t('app',
                    'Your request has been received. You will be contacted by one of our agents soon!'),
            ]);

            return $this->redirect(['site/index']);
        }

        return $this->render('index', ['model' => $model]);
    }
}
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
                'title' => Yii::t('app', 'Custom request received'),
                'message' => Yii::t('app',
                    'Your request for a custom offer on a trip to {destination} has been received {name}. 
You will be contacted by one of our agents soon!', [
                        'name' => $model->firstName,
                        'destination' => $model->destination
                    ]),
            ]);

            $model->trigger(CustomOffer::EVENT_AFTER_CUSTOM_REQUEST);

            return $this->redirect(['site/index']);
        }

        return $this->render('index', ['model' => $model]);
    }
}
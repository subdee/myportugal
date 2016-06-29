<?php
namespace backend\controllers;

use backend\models\CustomOffer;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class CustomOffersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return Yii::$app->user->identity->admin;
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = CustomOffer::getAll();

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}

<?php
namespace backend\controllers;

use common\models\Order;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class OrdersController extends Controller
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
        $dataProvider = Order::getOpen();

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}

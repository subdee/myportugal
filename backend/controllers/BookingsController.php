<?php
namespace backend\controllers;

use common\models\Booking;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class BookingsController extends Controller
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
        $dataProvider = Booking::getAll();

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}

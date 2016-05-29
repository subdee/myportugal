<?php
namespace backend\controllers;

use common\models\Booking;
use common\models\Flight;
use common\models\Hotel;
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

    public function actionAdd()
    {
        $booking = new Booking();
        $flight = new Flight();
        $hotel = new Hotel();

        if ($booking->load(Yii::$app->request->post())
            && $booking->flight->load(Yii::$app->request->post())
            && $booking->hotel->load(Yii::$app->request->post())
        ) {
            if ($booking->save()) {
                $this->redirect(['bookings/index']);
            }
        }

        return $this->render('add', ['booking' => $booking, 'hotel' => $hotel, 'flight' => $flight]);
    }

    public function actionUpdate($id)
    {
        $booking = Booking::findOne($id);
        $flight = $booking->flight;
        $hotel = $booking->hotel;

        if ($booking->load(Yii::$app->request->post())
            && $booking->flight->load(Yii::$app->request->post())
            && $booking->hotel->load(Yii::$app->request->post())
        ) {
            if ($booking->save()) {
                $this->redirect(['bookings/index']);
            }
        }

        return $this->render('add', ['booking' => $booking, 'hotel' => $hotel, 'flight' => $flight]);
    }

    public function actionActivate($id)
    {
        $booking = Booking::findOne($id);
        if ($booking) {
            $booking->updateAttributes(['active' => ! $booking->active]);
        }
        $this->redirect(['bookings/index']);
    }
}

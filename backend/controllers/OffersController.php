<?php
namespace backend\controllers;

use common\models\Flight;
use common\models\Hotel;
use common\models\Image;
use common\models\Offer;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class OffersController extends Controller
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
        $dataProvider = Offer::getAll();

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $offer = new Offer();
        $flight = new Flight();
        $hotel = new Hotel();
        $image = new Image();

        if ($offer->load(Yii::$app->request->post())
            && $offer->flight->load(Yii::$app->request->post())
            && $offer->hotel->load(Yii::$app->request->post())
        ) {
            $newImage = UploadedFile::getInstance($offer, 'photoFile');
            if ($newImage) {
                $image->create($newImage);
                $offer->photo = $image;
            }
            if ($offer->save()) {
                $this->redirect(['offers/index']);
            }
        }

        return $this->render('add', ['offer' => $offer, 'hotel' => $hotel, 'flight' => $flight]);
    }

    public function actionUpdate($id)
    {
        /** @var Offer $offer */
        $offer = Offer::findOne($id);
        $flight = $offer->flight;
        $hotel = $offer->hotel;
        $image = $offer->photo ?: new Image();

        if ($offer->load(Yii::$app->request->post())
            && $offer->flight->load(Yii::$app->request->post())
            && $offer->hotel->load(Yii::$app->request->post())
        ) {
            $newImage = UploadedFile::getInstance($offer, 'photoFile');
            if ($newImage) {
                $image->create($newImage);
                $offer->photo = $image;
            }
            if ($offer->save()) {
                $this->redirect(['offers/index']);
            }
        }

        return $this->render('add', ['offer' => $offer, 'hotel' => $hotel, 'flight' => $flight]);
    }

    public function actionActivate($id)
    {
        $offer = Offer::findOne($id);
        if ($offer) {
            $offer->updateAttributes(['active' => ! $offer->active]);
        }
        $this->redirect(['offers/index']);
    }
}

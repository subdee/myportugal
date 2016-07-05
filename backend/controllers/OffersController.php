<?php
namespace backend\controllers;

use common\models\Amenity;
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
                        'actions' => ['index', 'add', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return Yii::$app->user->identity->agent;
                        }
                    ],
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
        $dataProvider = Offer::getAll(Yii::$app->user->identity);

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
            $amnties = [];
            $amenities = (array)Yii::$app->request->post('Hotel')['amenities'];
            foreach ($amenities as $amenity) {
                $amnty = new Amenity();
                $amnty->type = $amenity;
                $amnty->assignIcon();
                $amnties[] = $amnty;
            }
            $offer->hotel->amenities = $amnties;
            
            $newImage = UploadedFile::getInstance($offer, 'photoFile');
            if ($newImage) {
                $image->create($newImage);
                $offer->photo = $image;
            }
            $offer->createdBy = Yii::$app->user->id;
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
        $amenities = $offer->hotel->amenities;
        $offer->hotel->amenities = [];
        foreach ($amenities as $amenity) {
            $offer->hotel->amenities[] = $amenity->type;
        }

        if ($offer->load(Yii::$app->request->post())
            && $offer->flight->load(Yii::$app->request->post())
            && $offer->hotel->load(Yii::$app->request->post())
        ) {
            $amnties = [];
            $amenities = (array)Yii::$app->request->post('Hotel')['amenities'];
            foreach ($amenities as $amenity) {
                $amnty = new Amenity();
                $amnty->type = $amenity;
                $amnty->assignIcon();
                $amnties[] = $amnty;
            }
            $offer->hotel->amenities = $amnties;

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
            $offer->updateAttributes(['active' => !$offer->active]);
        }
        $this->redirect(['offers/index']);
    }
}

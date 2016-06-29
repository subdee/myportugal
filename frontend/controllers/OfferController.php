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
        if (!$offer) {
            throw new NotFoundHttpException(Yii::t('app', 'This offer does not exist'));
        }

        return $this->render('index', ['offer' => $offer]);
    }

    public function actionBook($slug)
    {
        /** @var Offer|null */
        $offer = Offer::findOne(['slug' => $slug]);
        if (!$offer) {
            throw new NotFoundHttpException(Yii::t('app', 'This offer does not exist'));
        }

        $model = new BookingForm();
        $model->newsletter = true;

        if ($model->load(Yii::$app->request->post()) && $model->save($offer)) {
            Yii::$app->session->setFlash('success', [
                'type' => Growl::TYPE_SUCCESS,
                'icon' => 'fa fa-check',
                'title' => Yii::t('app', 'Booking successful'),
                'message' => Yii::t('app',
                    'Thank you for your booking {name}. You will be contacted by our agents for further details.', [
                        'name' => $model->firstName,
                    ]),
            ]);
            $this->redirect(['site/index']);
        }

        return $this->render('book', ['offer' => $offer, 'model' => $model]);
    }
}
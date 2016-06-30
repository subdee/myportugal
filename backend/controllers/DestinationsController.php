<?php
namespace backend\controllers;

use common\models\Destination;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class DestinationsController extends Controller
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
        $dataProvider = Destination::getAll();

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $destination = new Destination();

        if ($destination->load(Yii::$app->request->post())
            && $destination->save()
        ) {
            $this->redirect(['destinations/index']);
        }

        return $this->render('add', ['model' => $destination]);
    }

    public function actionActivate($id)
    {
        /** @var Destination|null */
        $destination = Destination::findOne($id);
        if ($destination) {
            $destination->updateAttributes(['active' => !$destination->active]);
        }
        $this->redirect(['destinations/index']);
    }
}

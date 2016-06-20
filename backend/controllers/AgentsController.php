<?php
namespace backend\controllers;

use common\models\SignupForm;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class AgentsController extends Controller
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
        $dataProvider = User::getAgents();

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $signupForm = new SignupForm();

        if ($signupForm->load(Yii::$app->request->post())
            && $signupForm->signup(false, true)
        ) {
            $this->redirect(['agents/index']);
        }

        return $this->render('add', ['model' => $signupForm]);
    }

    public function actionActivate($id)
    {
        $agent = User::findOne($id);
        if ($agent) {
            $agent->updateAttributes(['status' => ! $agent->status]);
        }
        $this->redirect(['agents/index']);
    }
}

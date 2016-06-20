<?php

/* @var $this yii\web\View */

use common\models\User;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'My Portugal Backend';
?>
<div class="row">
    <?= Html::a('Create new', ['agents/add'], ['class' => 'btn btn-success']) ?>
</div>
<div class="row">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            [
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{update}{activate}',
                'buttons' => [
                    'update' => function ($url) {
                        return Html::a(Icon::show('pencil'), $url, ['title' => Yii::t('app', 'Edit')]);
                    },
                    'activate' => function ($url, $model) {
                        if (Yii::$app->user->identity->admin) {
                            return Html::a(
                                Icon::show('dot-circle-o'),
                                Url::toRoute(['agents/activate', 'id' => $model->id]),
                                [
                                    'title' => $model->status === User::STATUS_ACTIVE ? Yii::t('app',
                                        'Deactivate') : Yii::t('app', 'Activate'),
                                    'class' => $model->status === User::STATUS_DELETED ? 'text-danger' : 'text-success'
                                ]
                            );
                        }

                        return '';
                    }
                ]
            ]
        ]
    ]) ?>
</div>
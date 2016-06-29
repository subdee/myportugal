<?php

/* @var $this yii\web\View */

use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'My Portugal Backend';
?>
<div class="row">
    <?= Html::a('Create new', ['offers/add'], ['class' => 'btn btn-success']) ?>
</div>
<div class="row">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' => false,
        'rowOptions' => function ($model) {
            if ($model->active) {
                return ['class' => 'text-success'];
            }

            return ['class' => 'text-danger'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'flight.airline',
            'hotel.name',
            'active:boolean',
            'updated_on:datetime',
            [
                'attribute' => 'creator.username',
                'visible' => Yii::$app->user->identity->admin
            ],
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
                                Url::toRoute(['offers/activate', 'id' => (string)$model->_id]),
                                [
                                    'title' => $model->active ? Yii::t('app', 'Deactivate') : Yii::t('app', 'Activate'),
                                    'class' => $model->active ? 'text-danger' : 'text-success'
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
<?php

/* @var $this yii\web\View */

use kartik\grid\GridView;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'My Portugal Backend';
?>
<div class="row">
    <?= Html::a('Create new', ['bookings/add'], ['class' => 'btn btn-success']) ?>
</div>
<div class="row">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'flight.airline',
            'hotel.name',
            'active:boolean',
            'updated_on:datetime',
            [
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{activate}',
                'buttons' => [
                    'activate' => function ($url, $model) {
                        return Html::a('Activate', Url::toRoute(['bookings/activate', 'id' => (string)$model->_id]));
                    }
                ]
            ]
        ]
    ]) ?>
</div>
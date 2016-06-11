<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'Bookings';
?>
<div class="site-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'offer.title',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->offer->title,
                        Url::to(['offers/update', 'id' => (string)$model->offer->_id]));
                }
            ],
            'fullName',
            'user.email:email',
            'phone',
            'mobile',
            'completedOn:datetime',
            [
                'attribute' => 'statusText',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::tag('span', $model->statusText, [
                        'class' => 'label label-' . $model->status
                    ]);
                },
                'contentOptions' => ['class' => 'text-center']
            ]
        ]
    ]) ?>
</div>

<?php

/* @var $this yii\web\View */

use yii\grid\GridView;

$this->title = 'Custom offer requests';
?>
<div class="site-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fullName',
            'email',
            'destination',
            'departureDate:datetime',
            'description',
            'duration',
            'requestedOn:datetime',
        ]
    ]) ?>
</div>

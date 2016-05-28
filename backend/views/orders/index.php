<?php

/* @var $this yii\web\View */

use yii\grid\GridView;

$this->title = 'My Portugal Backend';
?>
<div class="site-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date_completed:datetime',
            'status:boolean'
        ]
    ]) ?>
</div>

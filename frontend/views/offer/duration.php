<?php use kartik\icons\Icon; ?>

<div class="check-in">
    <label><?= Yii::t('app', 'Take off') ?></label>
    <span><?= Yii::$app->formatter->asDatetime($offer->flight->beginDepartureDate) ?></span>
</div>
<div class="duration text-center">
    <?= Icon::show('clock-o') ?>
    <span>
        <?= Yii::t('app', '{hours}h {minutes}m', [
            'hours' => $offer->flight->beginFlightDuration['hours'],
            'minutes' => $offer->flight->beginFlightDuration['minutes'],
        ]) ?>
    </span>
</div>
<div class="check-out">
    <label><?= Yii::t('app', 'Landing') ?></label>
    <span><?= Yii::$app->formatter->asDatetime($offer->flight->beginArrivalDate) ?></span>
</div>
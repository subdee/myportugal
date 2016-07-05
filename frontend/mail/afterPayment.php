<?= \Yii::t('app/emails', 'Hello, {name},', ['name' => $name]) ?>

<?= \Yii::t('app/emails', 'Your booking for a trip to {destination} is completed. Your trip begins on {beginDate}, 
so make sure you are prepared.', [
    'destination' => $destination,
    'beginDate' => \Yii::$app->formatter->asDate($beginDate),
]) ?>

<?= \Yii::t('app', 'We will soon be contacting you for further details.');
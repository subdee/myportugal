<?= \Yii::t('app/emails', 'Hello, {name},', ['name' => $name]);

\Yii::t('app/emails', 'Your request for a trip to {destination} is received.', [
    'destination' => $destination,
]);

\Yii::t('app', 'We will soon be contacting you for further details.');

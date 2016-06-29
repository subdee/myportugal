<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'languagepicker'],
    'controllerNamespace' => 'frontend\controllers',
    'language' => 'nl-NL',
    'components' => [
        'paypal' => [
            'class' => 'frontend/components/Paypal',
            'client_id' => 'AWsfzYDLNe-0ShKgUup9yYn3y2ckMzSuiMGKwQp53Bhp4VHhF6wH36IbcC-JNG301MefHHiGDqjsF7Ru',
            'client_secret' => 'EN7xGaUrtv5AQ1NXnDogFl8qGg9RIxmk6afY8xD9J0JtLaJL7EQNzStK3hzVdEt7UXKLkFk85dgfLWq1',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                    'sourceLanguage' => 'en-US',
                ],
            ],
        ],
        'languagepicker' => [
            'class' => 'lajax\languagepicker\Component',
            'languages' => ['nl-NL' => 'Nederlands', 'en-US' => 'English'],
            'cookieName' => 'language',
            'cookieDomain' => 'subdee.test',
            'expireDays' => 64,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<slug>' => 'offer/index',
                '<slug>/book/' => 'offer/book',
                '/' => 'site/index',
                '<action>' => 'site/<action>'
            ],
        ],
    ],
    'params' => $params,
];

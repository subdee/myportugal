<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME'),
            'username' => getenv('DB_USER'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => 'utf8',
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://' . getenv('MONGO_HOST') . ':27017/' . getenv('MONGO_DBNAME') . '',
        ],
    ],
];

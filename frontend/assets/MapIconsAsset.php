<?php

namespace frontend\assets;


use yii\web\AssetBundle;

class MapIconsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/map-icons/dist';
    public $css = [
        YII_DEBUG ? 'css/map-icons.css' : 'css/map-icons.min.css',
    ];
    public $depends = array(
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    );
}
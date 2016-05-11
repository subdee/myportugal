<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class FontAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Lato:300,400,700',
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
}
<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class IeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/ie.css',
    ];
    public $cssOptions = ['condition' => 'lte IE9'];
    public $js = [
        '//html5shiv.googlecode.com/svn/trunk/html5.js',
        '//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js'
    ];
    public $jsOptions = ['condition' => 'lt IE9'];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

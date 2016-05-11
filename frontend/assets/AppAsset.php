<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/flexslider.css',
        'css/animate.min.css',
        'css/site.css',
        'css/theme.css',
        'css/app.css'
    ];
    public $js = [
        'js/jquery.noconflict.js',
        'js/modernizr.2.7.1.min.js',
        'js/jquery-migrate-1.2.1.min.js',
        'js/jquery.placeholder.js',
        'js/jquery.flexslider-min.js',
        'js/jquery.stellar.min.js',
        'js/waypoints.js',
        'js/theme-scripts.js',
        'js/scripts.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\JuiAsset',
    ];
}

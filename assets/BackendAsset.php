<?php
namespace app\web\backend\assets;

use yii\web\AssetBundle;
use yii\bootstrap\BootstrapAsset;
use yii\web\YiiAsset;

class BackendAsset extends AssetBundle
{
    public $basePath = '@web/backend/assets';
    public $baseUrl = '@web/backend/assets';
    public $css = [
        'css/custom.css',
        'css/style.css',
        'css/styles.css',
    ];
    public $js = [
        'js/script.js',
        'https://use.fontawesome.com/c02f906310.js',
    ];
    public $depends = [
        BootstrapAsset::class
    ];
}
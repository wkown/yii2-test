<?php

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class CommonAsset extends AssetBundle
{

    /**
     * @var string
     */
    public $sourcePath = '@app/modules/admin/assets/common';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    /**
     * @var array
     */
    public $js = [
        'js/jquery-1.11.1.min.js',
        'js/bootstrap.min.js',
        'js/TweenMax.min.js',
        'js/resizeable.js',
        'js/joinable.js',
        'js/xenon-api.js',
        'js/xenon-toggles.js',
        'js/ajaxupload.js',
        'js/xenon-custom.js',
    ];

    public $css = [
        'css/fonts/linecons/css/linecons.css',
        'css/fonts/fontawesome/css/font-awesome.min.css',
        'css/bootstrap.css',
        'css/xenon-core.css',

        'css/custom.css',
    ];
    
    /**
     * @var array
     */
    public $depends = [
        'app\modules\admin\assets\AppAsset',
    ];
}

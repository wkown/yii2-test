<?php

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class XenonAsset extends AssetBundle
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
        'js/xenon-widgets.js',
        'js/devexpress-web-14.1/js/globalize.min.js',
        'js/devexpress-web-14.1/js/dx.chartjs.js',
        'js/toastr/toastr.min.js',
    ];

    public $css = [
        'css/xenon-forms.css',
        'css/xenon-components.css',
        'css/xenon-skins.css',
    ];
    
    /**
     * @var array
     */
    public $depends = [
        'app\modules\admin\assets\CommonAsset',
    ];
}

<?php
/**
 * layer js.
 * User: walkskyer
 * Date: 2016/6/7
 * Time: 20:58
 */

namespace app\assets;

use yii\web\AssetBundle;

class LayerAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/static/layer';
    public $css = [];
    public $js = [
        'layer.js'
    ];
    public $depends = [];
}
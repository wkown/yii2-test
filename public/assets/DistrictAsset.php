<?php
/**
 * district.
 * User: walkskyer
 * Date: 2016/6/7
 * Time: 20:58
 */

namespace app\assets;

use yii\web\AssetBundle;

class DistrictAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/static/district';
    public $css = [];
    public $js = [
        'district.js'
    ];
    public $depends = [];
}
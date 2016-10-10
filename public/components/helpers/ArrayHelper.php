<?php
/**
 * Created by PhpStorm.
 * User: walkskyer
 * Date: 2016/6/9
 * Time: 22:40
 */

namespace app\components\helpers;


class ArrayHelper extends \yii\helpers\ArrayHelper{
    /**
     * 合并数组保持键名不变
     * @param $a
     * @param $b
     * @return mixed
     * @author walkskyer
     */
    public static function mergeKey($a, $b) {
        foreach ($b as $k=>$v){
            $a[$k]=$v;
        }
        return $a;
    }
}
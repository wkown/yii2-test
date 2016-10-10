<?php
/**
 * 添加地区查询助手.
 * User: walkskyer
 * Date: 2016/6/11
 * Time: 22:53
 */

namespace app\components\helpers;


class District {
    /**
     * @param int $pid
     * @param int $perPage
     * @param int $page
     * @param string $order
     * @return mixed|array
     * @author walkskyer
     */
    public static function fetchDistricts($condition=[], $perPage=100, $page=1, $order='id ASC'){
        $rows = \app\models\District::find()
            ->where($condition)->limit($perPage)->offset(($page-1)*$perPage)->orderBy($order)->indexBy('id')->asArray()->all();
        return $rows;
    }

    /**
     * 基于pid获取
     * @param int $pid
     * @return array|mixed
     * @author walkskyer
     */
    public static function getDistricts($pid=0){
        $rows = self::fetchDistricts(['upid'=>$pid],500);
        return $rows;
    }

    /**
     * 基于pid获取
     * @param int $pid
     * @return array|mixed
     * @author walkskyer
     */
    public static function getDistrictsDropDown($pid=0,$cond=[]){
        $where = $cond?array_merge(['and', ['upid'=>(int)$pid]],$cond):['upid'=>(int)$pid];
        $rows = self::fetchDistricts($where,500);
        $target=[];
        foreach ($rows as $k=>$v){
            $target[$k]=$v['name'];
        }
        return $target;
    }

    /**
     * 获取所有城市
     * @param int $perPage
     * @param int $page
     * @param string $order
     * @return array|\yii\db\ActiveRecord[]
     * @author walkskyer
     */
    public function getCities($perPage=100, $page=1,$order='id ASC'){
        $rows = self::fetchDistricts(['level'=>1], $perPage, $page, $order);
        return $rows;
    }
}
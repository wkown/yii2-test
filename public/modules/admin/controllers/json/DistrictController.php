<?php
/**
 * 地区相关接口.
 * User: walkskyer
 * Date: 2016/6/12
 * Time: 23:00
 */
namespace app\modules\admin\controllers\json;

use Phalcon\Assets\Inline\Js;
use Yii;
use yii\filters\AccessControl;
//use yii\web\Controller;
use app\modules\admin\controllers\Controller;
use app\components\helpers\Json;
use app\components\helpers\District;

class DistrictController extends Controller{

    /**
     * @param int $pid
     * @author walkskyer
     */
    public function actionGetSub($pid=0){
        if($rows = District::getDistricts((int)$pid)){
            Json::success(1,'',Json::format_list($rows,1,count($rows),count($rows)));
        }
        Json::error(-501);
    }

    public function actionGetSubDropDown($pid=0){
        $rows = District::getDistrictsDropDown($pid);
        Json::success(1,'',Json::format_list($rows, 1, count($rows), count($rows)));
    }
}
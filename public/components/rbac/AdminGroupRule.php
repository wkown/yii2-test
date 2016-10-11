<?php
/**
 * 管理员分组测试.
 * User: walkskyer
 * Date: 2016/10/11
 * Time: 11:19
 */

namespace app\components\rbac;
use Yii;
use yii\rbac\Rule;


class AdminGroupRule extends Rule{
    public $name = 'adminGroup';

    public function execute($user, $item, $params)
    {
        $user = Yii::$app->getUser();
        if(!$user->getIsGuest()){
            $type = $user->identity->type;
            if($item->name == 'admin'){
                return $type == 100;
            }elseif ($item->name =='author'){
                return $type == 100 || $type ==2;
            }
        }
        return false;
    }
}
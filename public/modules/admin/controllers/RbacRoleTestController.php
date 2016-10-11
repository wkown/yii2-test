<?php
/**
 * 基于默认角色的权限功能测试.
 * @see app/components/rbac/AdminGroupRule
 * @see app/commands/RbacController::RbacRoleTest()
 * User: walkskyer
 * Date: 2016/10/11
 * Time: 11:35
 */

namespace app\modules\admin\controllers;

use Yii;
use yii\base\Module;

class RbacRoleTestController extends Controller
{

    public function __construct($id, Module $module, array $config=[])
    {
        parent::__construct($id, $module, $config);
        $requestedRoute = Yii::$app->requestedRoute;
        if(!Yii::$app->user->can($requestedRoute)){
            die('deny:'.$requestedRoute);
        }
    }
    public function actionIndex(){
        return $this->render('test',['msg'=>'Index']);
    }

    public function actionCreate(){
        return $this->render('test',['msg'=>'Create']);
    }

    public function actionUpdate(){
        return $this->render('test',['msg'=>'UPdate']);
    }

    public function actionDelete(){
        return $this->render('test',['msg'=>'Delete']);
    }

}
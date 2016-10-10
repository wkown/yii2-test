<?php
/**
 * RBAC 权限测试.
 * User: walkskyer
 * Date: 2016/10/10
 * Time: 16:28
 */

namespace app\modules\admin\controllers;
use Yii;
use yii\base\Module;

class AuthTestController extends Controller
{
    public function __construct($id, Module $module, array $config=[])
    {
        parent::__construct($id, $module, $config);
        if(!Yii::$app->getUser()->can(Yii::$app->requestedRoute)){
            die('deny:'.Yii::$app->requestedRoute);
        }
    }

    public function actionA1(){
        return $this->render('test',['msg'=>'A1']);
    }
    public function actionA2(){
        return $this->render('test',['msg'=>'A2']);
    }

    public function actionB1(){
        return $this->render('test',['msg'=>'B1']);
    }
    public function actionB2(){
        return $this->render('test',['msg'=>'B2']);
    }

}
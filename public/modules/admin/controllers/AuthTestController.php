<?php
/**
 * RBAC 权限测试.
 *
 * 规则设置 参见 app/commands/RbacController::actionAuthTest()
 * User: walkskyer
 * Date: 2016/10/10
 * Time: 16:28
 */

namespace app\modules\admin\controllers;
use Yii;
use yii\base\Module;
use yii\filters\AccessControl;

class AuthTestController extends Controller
{
    public function __construct($id, Module $module, array $config=[])
    {
        parent::__construct($id, $module, $config);
        $requestedRoute = Yii::$app->requestedRoute;
        $skipAction = strpos($requestedRoute,'admin/auth-test/c')===false;
        if($skipAction && !Yii::$app->getUser()->can($requestedRoute)){
            die('deny:'.$requestedRoute);
        }
    }

    //用于测试ACF于RBAC如何配合
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['c1', 'c2', 'c3','c4'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['c1', 'c2'],
                        'roles' => ['a'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['c3','c4'],
                        'roles' => ['b'],
                    ],
                ],
            ],
        ];
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

    //用于测试ACF于RBAC如何配合
    public function actionC1(){
        return $this->render('test',['msg'=>'C1']);
    }
    public function actionC2(){
        return $this->render('test',['msg'=>'C2']);
    }
    public function actionC3(){
        return $this->render('test',['msg'=>'C3']);
    }
    public function actionC4(){
        return $this->render('test',['msg'=>'C4']);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: zwj
 * Date: 2016/6/23
 * Time: 11:02
 */

namespace app\modules\admin\controllers;
use yii;
use yii\base\Module;
use app\models\Admin;

class Controller extends \yii\web\Controller
{
    /* @var Admin*/
    public $user;
    public function __construct($id, Module $module, array $config=[])
    {
        parent::__construct($id, $module, $config);

        if(!Yii::$app->user->isGuest)
        {

            $this->user=Admin::findOne(['admin_id'=>Yii::$app->user->getId()]);
            return true;
        }
        else
        {
            return $this->redirect(['/admin/site/login']);
        }
    }
}
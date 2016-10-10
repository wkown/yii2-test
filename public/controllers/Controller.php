<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\base\Module;

class Controller extends \yii\web\Controller
{
    public function __construct($id, Module $module, array $config=[])
    {
        parent::__construct($id, $module, $config);
        //var_dump(Yii::$app->requestedRoute);die();
    }
}

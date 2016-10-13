<?php

namespace app\modules\admin;
use Yii;
/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if(Yii::$app instanceof \yii\console\Application){
            $this->controllerNamespace='app\modules\admin\commands';
            Yii::configure(Yii::$app, require(__DIR__ . '/config/console.php'));
        }else{
            Yii::configure(Yii::$app, require(__DIR__ . '/config/web.php'));
        }
        // custom initialization code goes here
    }
}

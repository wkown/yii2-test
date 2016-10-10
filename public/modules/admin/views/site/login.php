<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\StringHelper;
use app\modules\admin\assets\CommonAsset;
$bundle = CommonAsset::register($this);

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?><?php $this->beginPage() ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />

    <?= Html::csrfMetaTags() ?>
    <title>Xenon - Dashboard</title>
    <?php $this->head() ?>
    <style>
        .center {
            width: 750px;
            display: table;
            margin-left: auto;
            margin-right: auto;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body class="page-body"><?php $this->beginBody() ?>
<div class="site-login center">
    <h1><?= Html::encode($this->title) ?> </h1>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe',[
            'template' => "<div class=\"col-lg-offset-2 col-lg-4\">{input} {label}</div>\n<div class=\"col-lg-6\">{error}</div>",
        ])->checkbox() ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
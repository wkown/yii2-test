<?php
/**
 * admin modules config.
 * User: walkskyer
 * Date: 2016/5/27
 * Time: 21:33
 */
$config = [
        'homeUrl'=>'/admin',
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\Admin',
            'enableAutoLogin' => true,
            'loginUrl' => ['/admin/site/login'],//定义后台默认登录界面[权限不足跳到该页]
            'identityCookie' => ['name' => '__admin_identity', 'httpOnly' => true],
            'idParam' => '__admin'
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['admin', 'author'],
            'assignmentFile' => '@app/modules/admin/rbac/assignments.php',
            'itemFile' => '@app/modules/admin/rbac/items.php',
            'ruleFile' => '@app/modules/admin/rbac/rules.php'
        ],]
];

return $config;
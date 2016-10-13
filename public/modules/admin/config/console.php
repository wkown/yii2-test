<?php
/**
 * admin modules config.
 * User: walkskyer
 * Date: 2016/5/27
 * Time: 21:33
 */
$config = [
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['admin', 'author'],
            'assignmentFile' => '@app/modules/admin/rbac/assignments.php',
            'itemFile' => '@app/modules/admin/rbac/items.php',
            'ruleFile' => '@app/modules/admin/rbac/rules.php'
        ],]
];

return $config;
<?php
namespace app\modules\admin\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // 添加 "createPost" 权限
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // 添加 "updatePost" 权限
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // 添加 "author" 角色并赋予 "createPost" 权限
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        // 添加 "admin" 角色并赋予 "updatePost"
        // 和 "author" 权限
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        // 为用户指派角色。其中 1 和 2 是由 IdentityInterface::getId() 返回的id （译者注：user表的id）
        // 通常在你的 User 模型中实现这个函数。
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
    }

    /**
     * 生成测试rbac功能的数据
     */
    public function actionAuthTest(){
        $auth = Yii::$app->authManager;

        $controller = $auth->createPermission('admin/auth-test');
        $auth->add($controller);

        // 添加 A 权限
        $a1 = $auth->createPermission('admin/auth-test/a1');
        $auth->add($a1);
        $a2 = $auth->createPermission('admin/auth-test/a2');
        $auth->add($a2);

        // 添加 "$aRole" 角色并赋予 "a" 权限
        $aRole = $auth->createRole('a');
        $auth->add($aRole);
        $auth->addChild($aRole, $controller);
        $auth->addChild($aRole, $a1);
        $auth->addChild($aRole, $a2);

        // 添加 B 权限
        $b1 = $auth->createPermission('admin/auth-test/b1');
        $auth->add($b1);
        $b2 = $auth->createPermission('admin/auth-test/b2');
        $auth->add($b2);

        // 添加 "$aRole" 角色并赋予 "a" 权限
        $bRole = $auth->createRole('b');
        $auth->add($bRole);
        $auth->addChild($bRole, $controller);
        $auth->addChild($bRole, $b1);
        $auth->addChild($bRole, $b2);

        // 为用户指派角色。其中 1 和 2 是由 IdentityInterface::getId() 返回的id （译者注：user表的id）
        // 通常在你的 User 模型中实现这个函数。
        $auth->assign($bRole, 2);
        $auth->assign($aRole, 1);
    }

    /**
     * 默认角色功能测试
     */
    public function actionRbacRoleTest(){
        $auth = Yii::$app->authManager;

        //角色分组规则
        $rule = new \app\modules\admin\components\rbac\AdminGroupRule();
        $auth->add($rule);

        //添加角色
        $roleAuthor = $auth->createRole('author');
        $roleAuthor->ruleName = $rule->name;
        $auth->add($roleAuthor);

        $roleAdmin  = $auth->createRole('admin');
        $roleAdmin->ruleName = $rule->name;
        $auth->add($roleAdmin);

        //角色上下级关系
        $auth->addChild($roleAdmin, $roleAuthor);

        //创建权限
        $controller = $auth->createPermission('admin/rbac-role-test');
        $index = $auth->createPermission('admin/rbac-role-test/index');
        $create = $auth->createPermission('admin/rbac-role-test/create');
        $update = $auth->createPermission('admin/rbac-role-test/update');
        $delete = $auth->createPermission('admin/rbac-role-test/delete');
        //添加权限
        $auth->add($controller);
        $auth->add($index);
        $auth->add($create);
        $auth->add($update);
        $auth->add($delete);


        //分配权限
        $auth->addChild($roleAuthor, $controller);
        $auth->addChild($roleAuthor, $create);
        $auth->addChild($roleAuthor, $index);

        $auth->addChild($roleAdmin,$update);
        $auth->addChild($roleAdmin, $delete);
    }
}
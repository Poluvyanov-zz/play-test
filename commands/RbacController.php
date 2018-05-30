<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "createPost"
        $createTask = $auth->createPermission('createTask');
        $createTask->description = 'Create a task';
        $auth->add($createTask);

        // добавляем разрешение "updateTask"
        $updateTask = $auth->createPermission('updateTask');
        $updateTask->description = 'Update task';
        $auth->add($updateTask);

        // добавляем роль "author" и даём роли разрешение "createTask"
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createTask);

        // добавляем роль "admin" и даём роли разрешение "updateTask"
        // а также все разрешения роли "author"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateTask);
        $auth->addChild($admin, $author);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
    }
}
<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;

class RbacController extends Controller
{
    public function actionRbacInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // Создание ролей
        $employer = $auth->createRole('employer');
        $student = $auth->createRole('student');
        $practice_manager = $auth->createRole('practice_manager');
        $admin = $auth->createRole('admin');

        // Запись ролей в бд
        $auth->add($employer);
        $auth->add($student);
        $auth->add($practice_manager);
        $auth->add($admin);

        // Добавление разрешений для общего пользователя (employer)
        $per_employer = $auth->createPermission('per_employer');
        $per_employer->description = 'Доступ в личный аккаунт. Добавить задачу. Просмотреть задачи. Редактировать задачу. Удалить задачу. Добавить предмет к задаче.';
        $auth->add($per_employer);
        $auth->addChild($employer, $per_employer);

        // Добавление разрешений для студента (student)
        $per_student = $auth->createPermission('per_student');
        $per_student->description = 'Отправить ответ на задачу. Изменить ответ. Отменить ответ.';
        $auth->add($per_student);
        $auth->addChild($student, $per_student);


        // Добавление разрешений для куратора (practice_manager)
        $per_practice_manager = $auth->createPermission('per_practice_manager');
        $per_practice_manager->description = 'Создать группу. Изменить группу. Удалить группу. Добавить студента в группу. Удалить студента из группы. Создать предмет. Удалить предмет. Добавить задачу для студентов. Изменить задачу. Удалить задачу. Просмотреть ответы студентов на задачу.';
        $auth->add($per_practice_manager);
        $auth->addChild($practice_manager, $per_practice_manager);

        // Добавление разрешений для администратора (admin)
        $can_admin = $auth->createPermission('can_admin');
        $can_admin->description = 'Все разрешения + создавать пользователей, изменять их удалять.';
        $auth->add($can_admin);
        $auth->addChild($admin, $can_admin);

        $auth->assign($admin, 1);
        echo 'ok';
        die;
    }
}
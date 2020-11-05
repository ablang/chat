<?php


namespace core\services;


use core\entities\User;
use core\forms\user\SignupForm;
use core\forms\user\UserRoleForm;
use core\Role;
use Yii;
use yii\rbac\ManagerInterface;

class UserService
{
    private ManagerInterface $roleManager;
    private TransactionManager $transactionManager;

    public function __construct(ManagerInterface $roleManager, TransactionManager $transactionManager)
    {
        $this->roleManager = $roleManager;
        $this->transactionManager = $transactionManager;
    }

    public function changeRole(int $id, $roleName)
    {
        $role = $this->roleManager->getRole($roleName);
        if (!$role) {
            throw new \DomainException('Role "' . $roleName . '" doesn=\'t exist.');
        }
        $this->transactionManager->wrap(function () use ($id, $role) {
            $this->roleManager->revokeAll($id);
            $this->roleManager->assign($role, $id);
        });
    }

    public function signup(SignupForm $form)
    {
        $user = User::create($form->username, $form->email, $form->password);
        $this->transactionManager->wrap(function () use ($user) {
            $user->save();
            $role = $this->roleManager->getRole(Role::ROLE_USER);
            $this->roleManager->assign($role, $user->id);
        }, function () use ($user) {
            Yii::$app->mailer
                ->compose(
                    ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                    ['user' => $user]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($user->email)
                ->setSubject('Account registration at ' . Yii::$app->name)
                ->send();
        });
    }
}
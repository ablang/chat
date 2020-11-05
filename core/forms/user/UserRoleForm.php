<?php


namespace core\forms\user;


use core\entities\User;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserRoleForm extends Model
{
    public $role;

    public function __construct(User $user, $config = [])
    {
        $roles = Yii::$app->authManager->getRolesByUser($user->id);
        $this->role = $roles ? reset($roles)->name : null;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['role', 'required']
        ];
    }

    public function rolesList()
    {
        return ArrayHelper::map(\Yii::$app->authManager->getRoles(), 'name', 'description');
    }
}
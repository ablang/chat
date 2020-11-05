<?php


namespace core\entities;


use yii\db\ActiveRecord;

/**
 * Class AuthAssignments
 * @package core\entities
 *
 * @property string $item_name
 * @property int $user_id
 */
class AuthAssignments extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%auth_assignments}}';
    }
}
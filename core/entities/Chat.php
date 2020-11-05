<?php


namespace core\entities;


use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class Chat
 * @package core\entities
 *
 * @property string $message
 * @property integer $createdAt
 * @property integer $id
 * @property integer $userId
 * @property boolean $hidden
 */
class Chat extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%chat}}';
    }

    public static function create($userId, $message): self
    {
        $item = new static;
        $item->createdAt = time();
        $item->message = $message;
        $item->userId = $userId;
        return $item;
    }

    public function hide()
    {
        $this->hidden = true;
    }

    public function show()
    {
        $this->hidden = false;
    }
}
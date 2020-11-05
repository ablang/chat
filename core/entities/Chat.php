<?php


namespace core\entities;


use core\queries\ChatQuery;
use yii\base\Model;
use yii\db\ActiveQuery;
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
 *
 * @property User $user
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

    public function isHidden()
    {
        return (int)$this->hidden == 1;
    }

    public function hide()
    {
        $this->hidden = true;
    }

    public function show()
    {
        $this->hidden = false;
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }

    public static function find(): ChatQuery
    {
        return new ChatQuery(static::class);
    }
}
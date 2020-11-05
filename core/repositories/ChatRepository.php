<?php


namespace core\repositories;


use core\entities\Chat;
use yii\web\NotFoundHttpException;

class ChatRepository
{
    public function save(Chat $chat)
    {
        if (!$chat->save()) {
            throw new \RuntimeException('Chat saving error');
        }
    }

    public function getById($id): Chat
    {
        $chat = Chat::findOne($id);
        if (!$chat) {
            throw new \DomainException('Chat not found');
        }
        return $chat;
    }
}
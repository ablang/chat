<?php

namespace core\services;

use core\entities\Chat;
use core\forms\ChatForm;
use core\repositories\ChatRepository;

class ChatService
{
    private ChatRepository $repository;

    public function __construct(ChatRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(ChatForm $form, $userId)
    {
        $chat = Chat::create($userId, $form->message);
        $this->repository->save($chat);
        return $chat;
    }

    public function show($id)
    {
        $chat = $this->repository->getById($id);
        $chat->show();
        $this->repository->save($chat);
    }

    public function hide($id)
    {
        $chat = $this->repository->getById($id);
        $chat->hide();
        $this->repository->save($chat);
    }
}
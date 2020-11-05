<?php


namespace core\forms;


use yii\base\Model;

class ChatForm extends Model
{
    public $message;

    public function rules()
    {
        return [
            ['message', 'required']
        ];
    }
}
<?php


namespace core\queries;


use yii\db\ActiveQuery;

class ChatQuery extends ActiveQuery
{
    public function hidden()
    {
        return $this->andWhere([
            'hidden' => 1,
        ]);
    }
}
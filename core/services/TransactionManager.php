<?php


namespace core\services;


class TransactionManager
{
    public function wrap(callable $function, callable $additional = null): void
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $function();
            $transaction->commit();
            if ($additional != null) {
                $additional();
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}
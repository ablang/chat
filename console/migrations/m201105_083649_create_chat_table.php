<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat}}`.
 */
class m201105_083649_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat}}', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'message' => $this->text()->notNull(),
            'hidden' => $this->boolean(),
        ]);

        $this->createIndex('idx-chat-userId', '{{%chat}}', 'userId');
        $this->addForeignKey('fk-chat-userId', '{{%chat}}', 'userId', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chat}}');
    }
}

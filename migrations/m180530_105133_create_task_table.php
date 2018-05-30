<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m180530_105133_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'task' => $this->text()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('task');
    }
}

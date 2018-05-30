<?php

use yii\db\Migration;

/**
 * Handles the creation of table `score`.
 */
class m180530_105409_create_score_table extends Migration
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

        $this->createTable('score', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),
            'status' => $this->boolean(),
            'user_id' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('score');
    }
}

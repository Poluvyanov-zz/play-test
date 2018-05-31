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

        $this->insert('task', [
            'task' => 'Риарден никогда не ощущал одиночества, кроме тех мгновений, когда бывал счастлив.',
        ]);

        $this->insert('task', [
            'task' => 'Никогда не сердись на человека за то, что он сказал правду.',
        ]);

        $this->insert('task', [
            'task' => 'Людям недоступны истина и разум. Они глухи к ним. Разум против них бессилен.',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('task');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `status`.
 */
class m180531_064232_create_status_table extends Migration
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

        $this->createTable('status', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ], $tableOptions);

        $this->insert('status', [
            'name' => 'win'
        ]);

        $this->insert('status', [
            'name' => 'fail'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('status');
    }
}

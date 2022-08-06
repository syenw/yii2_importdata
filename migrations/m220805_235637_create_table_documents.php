<?php

use yii\db\Migration;

/**
 * Class m220805_235637_create_table_documents
 */
class m220805_235637_create_table_documents extends Migration
{
    /**
     * {@inheritdoc}
     */
    // public function safeUp()
    // {

    // }

    /**
     * {@inheritdoc}
     */
    // public function safeDown()
    // {
    //     echo "m220805_235637_create_table_documents cannot be reverted.\n";

    //     return false;
    // }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('documents', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'size' => $this->double('3, 2')
        ]);
    }

    public function down()
    {
        $this->dropTable('documents');
    }
}

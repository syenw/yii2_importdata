<?php

use yii\db\Migration;

/**
 * Class m220802_135757_create_table_books
 */
class m220802_135757_create_table_books extends Migration
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
    //     echo "m220802_135757_create_table_books cannot be reverted.\n";

    //     return false;
    // }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'code' => $this->string(),
            'category' => $this->string(),
            'title' => $this->text(),
            'author' => $this->text(),
            'publisher' => $this->text(),
            'isbn' => $this->string(),
            'year' => $this->string(),
            'size' => $this->string(),
            'page' => $this->string(),
            'price' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('books');
    }
}

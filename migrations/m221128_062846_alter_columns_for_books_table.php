<?php

use yii\db\Migration;

/**
 * Class m221128_062846_alter_columns_for_books_table
 */
class m221128_062846_alter_columns_for_books_table extends Migration
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
        
    // }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('books', 'category', $this->text());
    }

    public function down()
    {
        
    }
}

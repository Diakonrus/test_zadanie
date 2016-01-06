<?php

use yii\db\Schema;
use yii\db\Migration;

class m151103_081716_tbl_pages extends Migration
{


    public function up()
    {

        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(250)->notNull(),
            'lastname' => $this->string(250)->notNull(),
            'created_at' => Schema::TYPE_TIMESTAMP,
        ]);



        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'name' => $this->string(250),
            'preview' => $this->string(150),
            'date_create' => 'datetime DEFAULT NULL',
            'date_update' => 'datetime DEFAULT NULL',
            'author_id' => 'int(10)  NOT NULL',
            'date' => 'date DEFAULT NULL',
        ]);


    }

    public function down()
    {
        echo "m151103_081716_tbl_pages cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

<?php

use yii\db\Migration;

class m161013_174508_rm_destinations extends Migration
{
    public function safeUp()
    {
        $this->dropTable('destination');
    }

    public function safeDown()
    {
        $this->createTable('{{%destination}}', [
            'id' => $this->primaryKey(),
            'destination' => $this->string()->notNull()->unique(),
            'slug' => $this->string()->notNull()->unique(),
            'active' => $this->boolean()->notNull()->defaultValue(0),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }
}

<?php

use yii\db\Migration;

class m160630_072203_destinations_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%destination}}', [
            'id' => $this->primaryKey(),
            'destination' => $this->string()->notNull()->unique(),
            'slug' => $this->string()->notNull()->unique(),
            'active' => $this->boolean()->notNull()->defaultValue(0),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    public function safeDown()
    {
        $this->dropTable('destination');
    }
}

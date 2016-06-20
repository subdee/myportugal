<?php

use yii\db\Migration;

class m160620_152345_add_agents_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'agent', $this->boolean()->notNull()->defaultValue(false));
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'agent');
    }
}

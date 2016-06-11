<?php

use yii\db\Migration;

class m160611_152011_add_newsletter_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'newsletter', $this->boolean()->notNull()->defaultValue(0));
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'newsletter');
    }
}

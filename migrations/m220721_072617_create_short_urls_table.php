<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%short_urls}}`.
 */
class m220721_072617_create_short_urls_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%short_urls}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255),
            'hash' => $this->string(5),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%short_urls}}');
    }
}

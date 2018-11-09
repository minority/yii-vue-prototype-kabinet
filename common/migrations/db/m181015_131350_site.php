<?php

use yii\db\Migration;

/**
 * Class m181015_131350_site
 */
class m181015_131350_site extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('{{%site}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'url' => $this->string(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createTable('{{%site_income_indicators}}', [
            'id' => $this->primaryKey(),
            'site_id' => $this->integer()->notNull(),
            'type' => $this->string(),
            'value' => $this->integer()
        ]);

        $this->addForeignKey('fk_site_income_indicators', '{{%site_income_indicators}}', 'site_id', '{{%site}}', 'id', 'cascade', 'cascade');
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_site_income_indicators', '{{%site_income_indicators}}');
        $this->dropTable('{{%site_income_indicators}}');
        $this->dropTable('{{%site}}');
    }
}

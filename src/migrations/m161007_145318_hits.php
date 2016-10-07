<?php

use yii\db\Migration;

class m161007_145318_hits extends Migration
{
    private $tablename='{{%hits}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

$this->createTable($this->tablename, [
    'hit_id' => $this->primaryKey(),
    'user_agent' => $this->string()->notNull(),
    'ip' => $this->string()->notNull(),
    'target_group' => $this->string()->notNull(),
    'target_pk' => $this->string()->notNull(),
    'created_at' => $this->integer()->notNull(),
]);

}

    public function down()
    {
        $this->dropTable($this->tablename);
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

<?php

use yii\db\Migration;

/**
 * Class m210215_182953_add_statuses
 */
class m210215_182953_add_statuses extends Migration
{
    private $tableName='{{%statuses}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName,[
            'status_id'=>$this->primaryKey(),
            'status_name'=>$this->string()->notNull()
        ]);
        $this->batchInsert($this->tableName,['status_name'],[['on the tree'],['fell']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210215_182953_add_statuses cannot be reverted.\n";

        return false;
    }
    */
}

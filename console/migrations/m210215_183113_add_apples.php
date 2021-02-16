<?php

use yii\db\Migration;

/**
 * Class m210215_183113_add_apples
 */
class m210215_183113_add_apples extends Migration
{
    private $tableName = '{{%apples}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName,[
            'id'=>$this->primaryKey(),
            'color'=>$this->string()->notNull(),
            'status_id'=>$this->integer()->notNull(),
            'integrity'=>$this->float()->defaultValue(1),
            'createAt'=>$this->integer()->defaultExpression("extract(epoch from now())"),
            'fallAt'=>$this->integer()
        ]);
        $this->addForeignKey(
            'status_id',
            $this->tableName,
            'status_id',
            '{{%statuses}}',
            'status_id',
            'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('status_id',$this->tableName);
        $this->dropTable($this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210215_183113_add_apples cannot be reverted.\n";

        return false;
    }
    */
}

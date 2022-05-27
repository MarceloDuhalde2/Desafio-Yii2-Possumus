<?php

use yii\db\Migration;

/**
 * Class m220527_190621_create_table_usuario
 */
class m220527_190621_create_table_usuario extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('usuarios', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(64)->notNull(),
            'apellido' => $this->string(64)->notNull(),
            'edad' => $this->integer()->notNull(),
            'email' => $this->string(64)->notNull(),
            'dni' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('usuarios');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220527_190621_create_table_usuario cannot be reverted.\n";

        return false;
    }
    */
}

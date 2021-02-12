<?php

use yii\db\Migration;

/**
 * Class m210212_040129_user_wallet_table
 */
class m210212_040129_user_wallet_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_wallet}}', [
            'id' => 'uuid DEFAULT uuid_generate_v4()',
            'sum' => $this->float()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_wallet}}');
    }

}

<?php

use yii\db\Migration;

/**
 * Class m210212_010253_payments_queue_table
 */
class m210212_010253_payments_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payment_item}}', [
            'id' => 'uuid DEFAULT uuid_generate_v4()',
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'data' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payment_item}}');
    }
}

<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель кошелька клиента
 * @property string id
 * @property int sum
 */
class UserWallet extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules() {
        return \yii\helpers\ArrayHelper::merge(
            parent::rules(),
            [
                [['id'], 'match', 'pattern' => '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-5][0-9a-f]{3}-[089ab][0-9a-f]{3}-[0-9a-f]{12}$/i'],
                [['sum'], 'number'],
            ]
        );
    }
}
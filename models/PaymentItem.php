<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель записи из очереди платежей
 * 
 * @property string $id
 * @property string $created_at
 * @property string $data
 */
class PaymentItem extends ActiveRecord
{
    const SIGNATURE_PATTERN = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-5][0-9a-f]{3}-[089ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return \yii\helpers\ArrayHelper::merge(
            parent::rules(),
            [
                [['id'], 'match', 'pattern' => '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-5][0-9a-f]{3}-[089ab][0-9a-f]{3}-[0-9a-f]{12}$/i'],
                [['created_at'], 'date'],
                [['data'], 'validateData'],
            ]
        );
    }
    
    /**
     * Валидация цифровой подписи
     * @param string $attribute
     */
    public function validateData($attribute) {
        $value = $this->$attribute;
        if ($value && (!isset($value['id']) || !preg_match(self::SIGNATURE_PATTERN, $value['id']))) {
            $this->addError('data', 'Неправильная цифровая подпись');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function afterFind() {
        if ($this->data && is_string($this->data)) {
            $this->data = json_decode($this->data);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        $this->data = json_encode($this->data);
        return parent::beforeSave($insert);
    }
}
<?php

namespace app\modules\v1\controllers;

use app\base\rest\Controller;
use app\models\PaymentItem;

/**
 * Контроллер платежей
 */
class PaymentsController extends Controller
{
    /**
     * Действие добавления нескольких платежей
     * @param string $json платежи в json формате
     * @return array
     */
    public function actionAdd($json) {
        $paymentsData = json_decode($json, true);

        $result = ['success' => true];

        if (is_array($paymentsData) && count($paymentsData) > 0) {
            $transaction = \Yii::$app->db->beginTransaction();
            $paymentItem = null;
            try {
                foreach($paymentsData as $data) {
                    $paymentItem = new PaymentItem();
                    $paymentItem->data = $data;
                    if (!$paymentItem->save()) {
                        throw new \Exception('Ошибка сохранения');
                    }
                }
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollback();
                if ($paymentItem && count($paymentItem->errors) > 0) {
                    return ['success' => 'false', 'errors' => $paymentItem->errors];
                }
                return ['success' => false, 'errors' => [$e->getMessage()]];
            }
            $result['count'] = count($paymentsData);
        }

        return $result;
    }

    /** 
     * Запрос на вывод всех кошельков пользователей
     */
    public function actionUserWallets() {
        return \app\models\UserWallet::find()->all();
    }

    /** 
     * Запрос на вывод всех платежей
     */
    public function actionGetAll() {
        return \app\models\PaymentItem::find()->all();
    }
}
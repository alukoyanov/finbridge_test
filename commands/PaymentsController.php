<?php

namespace app\commands;

use yii\console\Controller;
use app\models\PaymentItem;
use app\models\UserWallet;

class PaymentsController extends Controller
{
    /**
     * Команда обработки очереди платежей
     */
    public function actionProcessQueue() {
        if ($this->processIsRun('payments/process-queue')) {
            return;
        }

        $queueQuery = PaymentItem::find()
            ->orderBy('created_at')
            ->asArray();

        foreach ($queueQuery->batch(10000) as $payments) {
            foreach ($payments as $paymentData) {
                $data = json_decode($paymentData['data'], true);

                $userWallet = UserWallet::findOne(['id' => $data['order_number']]);
                if (!$userWallet) {
                    $userWallet = new UserWallet();
                    $userWallet->id = $data['order_number'];
                }
                $userWallet->sum += ($data['sum'] * ((100 - $data['commision']) / 100));
                $userWallet->save();
            }
        }
    }

    /**
     * Проверяем, что процесс запущен
     * @param string $processName Имя процесса
     * @return bool
     */
    public function processIsRun($processName)
    {
        $result = [];
        exec("ps aux | grep -v grep | grep \"$processName\"", $result);
        $count = count($result);
        return ceil($count) > 2;
    }
}
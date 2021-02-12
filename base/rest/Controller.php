<?php

namespace app\base\rest;

use yii\web\Controller as BaseController;

/**
 * Базовый класс для контроллеров REST API
 */
class Controller extends BaseController 
{
    /**
     * Действия перед любым запросе
     * @param yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }
}
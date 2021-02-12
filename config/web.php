<?php

$config = require(__DIR__ . '/common.php');

$config = \yii\helpers\ArrayHelper::merge($config, [
    'modules'    => [
        'v1' => [
            'class' => 'app\modules\v1\Module',
            'basePath' => '@app/modules/v1',
        ],
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [],
        ],
        'request' => [
            'cookieValidationKey' => getenv('APP_COOKIE_VALIDATION_KEY'),
        ],
        // 'response' => [
        //     'formatters' => [
        //         \yii\web\Response::FORMAT_JSON => [
        //             'class' => 'yii\web\JsonResponseFormatter',
        //             'prettyPrint' => YII_DEBUG,
        //             'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
        //         ],
        //     ],
        // ]
    ],
]);

if (getenv('YII_DEBUG')) {
    $config['bootstrap'][] = 'debug';
    $config['components']['log'] = [
        'traceLevel' => 3,
    ];
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
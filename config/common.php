<?php

Yii::setAlias('@app', dirname(__DIR__));

$config = [
    'id'         => getenv('APP_NAME'),
    'name'       => getenv('APP_TITLE'),
    'basePath'   => '@app',
    'language'   => 'ru-RU',
    'components' => [
        'db' => [
            'class'               => 'yii\db\Connection',
            'dsn'                 => 'pgsql:host='.getenv('POSTGRES_VHOST').';port='.getenv('POSTGRES_PORT').';dbname='.getenv('POSTGRES_DB'),
            'username'            => getenv('POSTGRES_USER'),
            'password'            => getenv('POSTGRES_PASSWORD'),
            'charset'             => 'utf8',
            'enableSchemaCache'   => true,
            'schemaCacheDuration' => 300,
            'tablePrefix'         => 'prc_',
            'masterConfig'        => [
                'attributes' => [
                    PDO::ATTR_TIMEOUT => 60,
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];

return $config;
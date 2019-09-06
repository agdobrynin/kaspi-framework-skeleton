<?php
return [
    'displayErrorDetails' => true,
    'db' => [
        /* для соединения через \PDO */
        'dsn' => 'sqlite:'.__DIR__.'/../store/db.db',
        'user' => '',
        'password' => '',
        'options' => [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ],
        /* миграции в БД vendor/bin/kaspi-migration --help */
        'migration' => [
            /* куда складывать и откуда файлы миграций */
            'path' => __DIR__.'/../migration',
            /* имя таблицы миграций, не обязательное поле, по умолчанию будет таблицу migration */
            'table' => 'migrations',
        ],
    ],
    'view' => [
        'path' => __DIR__.'/../app/view',
        'useExtension' => false,
    ],
    'csrf' => [
        /* срок жизни токена для CSRF защиты форм, TTL */
        'ttl' => 1800,
        /* имя токена для форм */
        'name' => 'xCsrf',
        /* длина ключа */
        'length' => 32,
    ],
    'router' => [
        'trailingSlash' => true,
    ],
    'default_timezone' => 'Europe/Samara',
    'locale' => [
        'category' => LC_ALL,
        // может быть массивом, может быть строкой
        'locale' => ['ru_RU', 'RU_RU'],
    ],
];

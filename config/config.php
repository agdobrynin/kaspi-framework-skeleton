<?php
return [
    'displayErrorDetails' => true,
    'db' => [
        /* для соединения через \PDO */
        'dsn' => getenv('DB_PDO'),
        'user' => getenv('DB_USER') ?: '',
        'password' => getenv('DB_PASS') ?: '',
        'options' => [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
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

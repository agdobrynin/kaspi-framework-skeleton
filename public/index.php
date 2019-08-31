<?php
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__.'/../vendor/autoload.php';
// Загрузка переменных окружения
(new Dotenv())->load(__DIR__ . '/../.env');
// Загрузка конфигурации
$config = new \Kaspi\Config(require __DIR__.'/../config/config.php');
//Стартанем сессию
session_start();
// Экземпляр приложения
$app = \App\AppFactory::create($config);
$app->run();

<?php

namespace App;

use Kaspi\App;
use Kaspi\Config;
use Kaspi\Request;
use Kaspi\Response;
use Kaspi\View;

class AppFactory
{
    public static function create(Config $config): App
    {
        // Экземпляр приложения
        $app = new App($config);
        // Установка локали
        $app->setLocale();
        // Установка таймзоны приложения
        $app->setTimeZone();
        // подключаемые зависимости приложения - контейнеры, базы данных и т.п.
        require_once __DIR__ . '/../../config/dependencies.php';
        // кастомные обработчки ошибок notFoundHandler, notAllowedHandler, errorHandler, phpHandler
        require_once __DIR__ . '/../../config/errorHandlers.php';
        // WEB роуты
        require_once __DIR__ . '/../../config/routes.php';

        return $app;
    }
}

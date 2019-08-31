<?php

namespace App;


use Kaspi\App;
use Kaspi\Config;
use Kaspi\Exception\RouterException;
use Kaspi\Request;
use Kaspi\Response;
use Kaspi\ResponseCode;
use Kaspi\View;

class AppFactory
{
    public static function create(Config $config): App
    {
        // Экземпляр приложения
        $app = new App($config, new Request(), new Response());
        // Установка локали
        $app->setLocale();
        // Установка таймзоны приложения
        $app->setTimeZone();
        // подключаемые зависимости приложения - контейнеры, базы данных и т.п.
        require_once __DIR__ . '/../../config/dependencies.php';
        // WEB роуты
        try {
            require_once __DIR__ . '/../../config/routes.php';
        } catch (RouterException $exception) {
            $errorTitle = 'Ошибка роутинга';
            $TraceAsString = getenv('APP_ENV') === App::APP_PROD ? '' : $exception->getTraceAsString();
            $Message = $exception->getMessage();
            $response = $app->getResponse();
            $response->errorHeader(ResponseCode::INTERNAL_SERVER_ERROR);
            $response->setBody(
                $app->getContainer()->get(View::class)->render(
                        'errors/exception',
                        compact(['Message', 'errorTitle', 'TraceAsString'])
                    )
            );
            echo $response->emit();
            die;
        }
        return $app;
    }
}

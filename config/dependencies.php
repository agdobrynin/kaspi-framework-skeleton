<?php

use \Kaspi\Exception\ViewException;
use Kaspi\View;

// Контейнер view
$app->getContainer()->set(View::class, static function () use ($config, $app): View {
    try {
        /** @var View $view */
        $view = new View($config, $app->getContainer());

        // Пример добавления экспешнеша для View
        // routeByName отдает паттрен роута по имени если есть
        try {
            /** @var \Kaspi\Router $router */
            $router = $app->getContainer()->{\Kaspi\Router::class};
            $view->addExtension('routeByName', static function ($pathName) use ($router) {
                return $router->getRoutePatternByName($pathName) ?: '';
            });
        } catch (\Kaspi\Exception\ContainerException $exception) {
            // TODO надо бы добавить логирование для приложения, например через monolog
        }

    } catch (ViewException $exception) {
        throw new \Kaspi\Exception\AppException($exception->getMessage());
    }

    return $view;
});
// Инициализация конектора БД
new Kaspi\Db($config);

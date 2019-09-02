<?php

use Kaspi\{View, Config, Router, Request};

$container = $app->container;
// Контейнер view
$app->getContainer()->set(View::class, static function () use ($container): View {
        /** @var View $view */
        $view = new View($container->{Config::class});
        // Пример добавления экспешнеша для View
        // pathFor отдает паттрен роута по имени если есть
        /** @var Router $router */
        $router = $container->{Router::class};
        $view->addExtension('pathFor', static function ($pathName) use ($router) {
            return $router->getRoutePatternByName($pathName) ?: '';
        });
        // Пример добавления экспешнеша для View
        // URI вызов в шаблоне $this->addExtension('URI') вернет текущий URI из объекта REQUEST
        /** @var Request $request */
        $request = $container->{Request::class};
        $view->addExtension('URI', static function () use ($request) {
            return $request->uri();
        });

    return $view;
});
// Инициализация конектора БД
new Kaspi\Db($config);

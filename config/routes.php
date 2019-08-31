<?php
$app->get('/', App\Controllers\Index::class)->setName('main');
$app->get('/task/add', App\Controllers\Task\Add::class)
    ->setName('task.add')
    ->middleware(App\Middleware\TemplateTransform::class);
$app->get('/task/show/(?<id>\d+)', App\Controllers\Task\Show::class)->setName('task.show');
//// Авторизация
$app->get('/login', App\Controllers\Auth::class . '@show')->setName('login');
$app->post('/login', App\Controllers\Auth::class . '@login');
$app->get('/logout', App\Controllers\Auth::class . '@logout')->setName('logout');
//
// Защита POST формы через Csrf - по токену
$app->middleware(App\Middleware\CsrfMiddleware::class);

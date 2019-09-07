<?php
$app->get('/', App\Controllers\Index::class)
    ->middleware(App\Middleware\TemplateTransform::class)
    ->setName('main');
$app->get('/page/(?<page>\d+)', App\Controllers\Index::class)
    ->setName('task.page');

$app->get('/task/add', App\Controllers\Task\Add::class)->setName('task.add');
$app->get('/task/view/(?<id>\d+)', App\Controllers\Task\View::class)->setName('task.view');
$app->get('/task/edit/(?<id>\d+)', App\Controllers\Task\Edit::class)->setName('task.edit');
$app->post('/task/add', App\Controllers\Task\Store::class);

// Работа с тестовыми данными
$app->get('/fake/create', App\Controllers\FakeData::class . '@create')->setName('fake.create');
$app->get('/fake/delete', App\Controllers\FakeData::class . '@delete')->setName('fake.delete');

// Авторизация
$app->get('/login', App\Controllers\Auth::class . '@show')->setName('login');
$app->post('/login', App\Controllers\Auth::class . '@login');
$app->get('/logout', App\Controllers\Auth::class . '@logout')->setName('logout');
$app->get('/json/(?<isbn>([a-z]{3})-([0-9]{4,6})-([a-z]{3,}))', static function (string $isbn) use ($app) {
    $app->response->setJson(['Found ISBN' => $isbn]);
});
// Защита POST формы через Csrf - по токену
$app->middleware(App\Middleware\CsrfMiddleware::class);

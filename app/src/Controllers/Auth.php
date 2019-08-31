<?php

namespace App\Controllers;

use App\Auth as UserAuth;
use Kaspi\Controller;
use Kaspi\FlashMessages;
use Kaspi\View;

class Auth extends Controller
{
    public function show(): void
    {
        if (!UserAuth::isAuth()) {
            FlashMessages::add('Пройдите авторизацию', FlashMessages::WARNING);
            FlashMessages::add(
                '<strong>Это тестовый режим!</strong> Для авторизации: <ul><li>логин admin <li>пароль 123</li>',
                FlashMessages::INFO
            );
            $referer = $this->request->getEnv('HTTP_REFERER');
            $this->response->setBody(
                $this->container->{View::class}->render('login', compact('referer'))
            );
            return;
        }
        $this->response->redirect($this->pathFor('main'));
    }

    public function logout(): void
    {
        UserAuth::logout();
        FlashMessages::add('Вы успешно вышли из системы', FlashMessages::SUCCESS);
        $this->response->redirect($this->pathFor('main'));
    }

    public function login(): void
    {
        [$login, $password, $referer] = $this->request->getParamsAsVariable('login', 'password', 'referer');
        if (UserAuth::login($login, $password)) {
            FlashMessages::add('Добродожаловать '.$login, FlashMessages::SUCCESS);
            $this->response->redirect($referer ?: '/');
            return;
        }
        FlashMessages::add('Ошибка авторизации', FlashMessages::ERROR);
        $this->response->setBody(
            $this->container->{View::class}->render('login', compact('referer'))
        );
    }
}

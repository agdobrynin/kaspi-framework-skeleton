<?php

namespace App;

class Auth
{
    // Временное хранение пары логин и пароль для авторизации
    private const AUTH_PAIR = ['admin', '123'];
    private const SESSION_KEY = 'isAuth';

    public static function login(string $login, string $password): bool
    {
        if (self::AUTH_PAIR === [$login, $password]) {
            $_SESSION[self::SESSION_KEY] = true;
        } else {
            self::logout();
        }

        return self::isAuth();
    }

    public static function isAuth(): bool
    {
        return !empty($_SESSION[self::SESSION_KEY]);
    }

    public static function logout(): bool
    {
        unset($_SESSION[self::SESSION_KEY]);

        return true;
    }
}

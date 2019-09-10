<?php

namespace App;

class Auth
{
    private const SESSION_KEY = 'isAuth';

    public static function login(string $login, string $password): bool
    {
        $authPair = [getenv('ADMIN_LOGIN'), getenv('ADMIN_PASSWORD')];
        if ($authPair === [$login, $password]) {
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

<?php

namespace library;

class Token
{
    /**
     * Генерирует токен
     *
     * @return void
     */
    public static function generate()
    {
        return Session::put(Config::get('session.tokenName'), md5(uniqid()));
    }

    /**
     * Проверяет правильный ли токен
     *
     * @param [type] $token
     * @return void
     */
    public static function check($token)
    {
        $tokenName = Config::get('session.tokenName');

        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }
}


?>
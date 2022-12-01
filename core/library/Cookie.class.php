<?php

namespace library;

/**
 * Этот класс работает с куки файлами
 */
class Cookie
{
    /**
     * Проверяет на наличие куки файла
     *
     * @param [type] $name
     * @return void
     */
    public static function exists($name)
    {
        return (isset($_COOKIE[$name])) ? true : false ;
    }

    /**
     * Получаем кук файл по названия
     *
     * @param [type] $name
     * @return void
     */
    public static function get($name)
    {
        return $_COOKIE[$name];
    }

    /**
     * Этот метод создает куки файлы
     *
     * @param string $name
     * @param string $value
     * @param integer $expiry
     * @return void
     */
    public static function put($name, $value, $expiry)
    {
        if (setcookie($name, $value, time() + $expiry, '/')) {
            return true;
        }
        return false;
    }

    /**
     * Удаляет кук файл по названия ключа
     *
     * @param [type] $name
     * @return void
     */
    public static function delete($name)
    {
        self::put($name, '', time() - 1);
    }
}


?>
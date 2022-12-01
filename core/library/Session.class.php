<?php

namespace library;

class Session
{
    /**
     * К сессии присваивем ключ и значения
     *
     * @param [type] $name
     * @param [type] $value
     * @return void
     */
    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    /**
     * Проверяет на наличе сессии по ключу
     *
     * @param [type] $name
     * @return void
     */
    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    /**
     * Удаляет сессию
     *
     * @param [type] $name
     * @return void
     */
    public static function delete($name)
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Этот метод возвращяет массив по названия
     *
     * @param [type] $name
     * @return void
     */
    public static function get($name)
    {
        return $_SESSION[$name];
    }

    /**
     * Этот мето нужен для того чтобы создать временную сессию
     *
     * @param [type] $name
     * @param string $string
     * @return void
     */
    public static function flash($name, $string = '')
    {
        if (self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        }else {
            self::put($name, $string);
        }
    }
}


?>
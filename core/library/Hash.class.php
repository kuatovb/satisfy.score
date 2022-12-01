<?php

namespace library;

class Hash
{
    /**
     * Хеширует данные с солью или без неё
     *
     * @param [type] $string
     * @param string $salt
     * @return void
     */
    public static function make($string, $salt = '')
    {
        return hash('sha256', $string . $salt);
    }

    /**
     * Генерирует ключ
     *
     * @param integer $length
     * @return void
     */
    public static function salt($length = 64)
    {
        $length = ($length < 4) ? 4 : $length;
        return bin2hex(random_bytes(($length-($length%2))/2));
    }

    /**
     * Создаёт уникальный хеш 
     *
     * @return void
     */
    public static function unique()
    {
        return self::make(uniqid());
    }
}


?>
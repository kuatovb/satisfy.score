<?php

namespace library;

class Config
{
    /**
     * Работа с конф. фалом
     *
     * @param [type] $path
     * @return void
     */
    public static function get($path = null)
    {
        if ($path) {

            // $GLOBALS['config']['mysql']['host'] из этой записи 
            // превращяем в эту Config::get('mysql.host');
            // чтобы выглядело красиво и для личного удобства

            $config = $GLOBALS['config'];
            $path = explode('.', $path);


            // в цикле проверяем на наличие записи, если есть то вытаскиваем запись из конфига
            foreach ($path as $bit) {

                if (!isset($config[$bit])) {
                    return null;
                }
                
                $config = $config[$bit];
            }

            return $config;
        }

        return false;
    }
}


?>
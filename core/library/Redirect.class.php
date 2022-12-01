<?php

namespace library;

class Redirect
{
    /**
     * Это костамизированная функция header();
     * Если выходит это ошибка "Warning: Cannot modify header information - headers already sent by..."
     * В php.ini output_buffering = On
     *
     * @param [type] $location
     * @return void
     */
    public static function to($location = null)
    {
        if ($location) {

            if (is_numeric($location)) {
                switch ($location) {
                    case 404:
                        header("HTTP/1.0 404 Not Found");
                        require_once __DIR__.'/../../cgi-bin/404.php';
                        die();
                    break;
                }
            }

            header('Location: ' . $location);
            die();
        }
    }
}

?>
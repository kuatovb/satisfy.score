<?php

namespace library;


/**
 * Class Url
 * @package library
 */
class Url
{
/*
    private $_url;
    private $_segments;
    private $_params;

    public function __construct()
    {
        $this->_url = $_SERVER['REQUEST_URI'];
        $this->getSegmentsFromUrl();
        $this->_params = $_GET;
        unset($this->_params['url']);
    }
*/

    /**
     * Получаем сегменты из из $_GET['url'] 
     * http://example.com/?url=
     * Все get-запросы превращаются в массив
     *
     * @return array
     */
    protected static function getSegmentsFromUrl()
    {
        $segments = explode('/', $_GET['url']);

        // удаляем последни элемент массива из url 
        // например http://example.com/segment/ удаляем его

        if (empty($segments[count($segments)-1])) {
            unset($segments[count($segments)-1]);
        }

        $segments = array_map(function ($v){

            return preg_replace('/[\'\\\*]/','', $v);
            
        }, $segments);

        return $segments;
    }


    /**
     * Undocumented function
     *
     * @param string $paramName
     * @return string
     */
    public static function getParam($paramName)
    {
        return addslashes($_GET[$paramName]);
    }


    /**
     * Получаем сегмент из массива 
     * например из url http://example.com/segment/
     * 
     * Url::getSegment(0); // segment
     *
     * @param integer $n
     * @return string|null
     */
    public static function getSegment($n)
    {
        $segments = self::getSegmentsFromUrl();
        return $segments[$n];
    }


    /**
     * Получаем все сегменты из $_GET['url']
     *
     * @return void
     */
    public static function getAllSegments()
    {
        return self::getSegmentsFromUrl();
    }
/*
    public function getUrlString()
    {
        return $this->_url;
    }
*/

}


?>
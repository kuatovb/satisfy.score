<?php

namespace library;

class Router
{
    public $routes = array();
    private $host;

    public function __construct($host)
    {
        $this->host = $host;
    }

    /**
     * @param [type] $key
     * @param [type] $pattern
     * @param [type] $controller
     * @param string $method
     * @return void
     */
    public function add($key, $pattern, $controller, $method = 'GET')
    {
        $this->routes[$key] = array(
            'pattern' => $pattern,
            'controller' => $controller,
            'method' => $method
        );
    }
}

<?php

namespace Acme;

class Route
{
    private $root;

    private $httpMethod;

    private $controller;

    private $action;

    private $httpQueryString;

    private function __construct()
    {
        $this->root = dirname($_SERVER['SCRIPT_NAME']);
        $requestUri = str_replace('index.php', '', $_SERVER['REQUEST_URI']);
        $this->httpQueryString = $_SERVER['QUERY_STRING'];
        if ($this->httpQueryString) {
            $requestUri = str_replace('?' . $this->httpQueryString, '', $requestUri);
        }
        $pathInfo = explode('/', substr($requestUri, strlen($this->root)));
        if (count($pathInfo)) {
            $this->httpMethod = strtolower($_SERVER['REQUEST_METHOD']);
            $this->controller = $pathInfo[0];
            $this->action = 'index';
            if (count($pathInfo) > 1) {
                $this->action = $pathInfo[0];
            }
        }
    }

    public function execute()
    {
        if (!$this->controller) {
            die("no controller");
        }
        $classname = 'Acme\\Controllers\\'.ucfirst($this->controller).'Controller';
        $methodName = ucfirst($this->action);

        $instance = new $classname;

        return $instance->$methodName();
    }

    private static $sigleton;

    public static function defaultRoute()
    {
        if (is_null(self::$sigleton)) {
            return new Route;
        }
        return self::$sigleton;
    }
}

<?php

namespace App\Base;

class Route{
    public $uri;
    public $action;
    public $controller;
    public $method;
    public $middleware;

    public function __construct($method, $uri,$controller, $action, $middleware = []){
        $this->method = $method;
        $this->uri = $uri;
        $this->controller = $controller;
        $this->action = $action;
        $this->middleware = $middleware;
    }

    public static function get($route,$controller,$action){
        return new Route("GET",$route,$controller,$action);
    }
    public static function post($route, $controller, $action){
        return new Route("POST",$route,$controller,$action);
    }
}
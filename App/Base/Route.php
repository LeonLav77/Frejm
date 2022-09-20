<?php

namespace App\Base;

class Route{
    public $uri;
    public $action;
    public $controller;
    public $method;

    public function __construct($method, $uri,$controller, $action){
        $this->method = $method;
        $this->uri = $uri;
        $this->controller = $controller;
        $this->action = $action;
    }

    public static function get($route,$controller,$action){
        return new Route("GET",$route,$controller,$action);
    }
    public static function post($route, $controller, $action){
        return new Route("POST",$route,$controller,$action);
    }
}
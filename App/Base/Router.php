<?php

namespace App\Base;

use routes\Routes;
use App\Base\Response;

class Router {
    public $routes = [];
    public function __construct(){
        $this->routes = (new Routes)->routes;
    }
    public function handle($request){
        if(!isset($this->routes[$request->uri])){
            return new Response("404 Page not found");
        }
        $route = $this->routes[$request->uri];
        if ($route->method == $request->method){
            if (class_exists($route->controller)){
                $controller = new $route->controller;
                if (method_exists($controller, $route->action)){
                    $response = $controller->{$route->action}($request);
                }else{
                    $response = new Response("Method " . $route->action . " does not exist in " . $route->controller);
                }
            }else{
                $response = new Response("Controller " . $route->controller . "does not exist");
            }
            return $response;
        }
        return new Response(404);
    }
}
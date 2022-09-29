<?php

namespace App\Http;

use bootstrap\App;
use Leonlav77\Frejmcore\Base\Router;
use Leonlav77\Frejmcore\Base\Response;

class Kernel {
    public $middleware = [ 
        \App\Http\Middleware\ParamMiddleware::class,
        \App\Http\Middleware\VerbMiddleware::class,
    ];
    public $routeMiddleware = [
        'param' => \App\Http\Middleware\ParamMiddleware::class,
        'test' => \App\Http\Middleware\TestMiddleware::class,
    ];
    public $router;
    public $app;
    public function __construct(App $app, Router $router) {
        $this->app = $app;
        $this->router = $router;

        $this->middleware = array_map(function($middleware){
            return new $middleware;
        }, $this->middleware);
    }
    public function handle($request){
        $response = $this->router->handle($request);
        $error = $this->handleMiddleware($request);
        if ($error){
            return $error;
        }
        return $response;
    }

    public function handleMiddleware($request){
        $error = 0;
        $this->combineMiddleware($request);
        foreach($this->middleware as $middleware){
            if($error instanceof Response){
                return $error;
            }
            $error = $middleware($request);
        }
    }
    public function combineMiddleware($request){
        if(!isset($this->router->routes[$request->uri]->middleware)){
            return;
        }
        $routeMiddleware = $this->router->routes[$request->uri]->middleware;
        if (!is_array($routeMiddleware)){
            $routeMiddleware = [$routeMiddleware];
        }
        foreach ($routeMiddleware as $middleware){
            $this->middleware[] = new $this->routeMiddleware[$middleware];
        }
    }
}
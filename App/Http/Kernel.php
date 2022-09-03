<?php

namespace App\Http;

use App\Base\Router;
use App\Base\Response;

class Kernel {
    public $middleware = [ 
        \App\Middleware\VerbMiddleware::class,
        \App\Middleware\ParamMiddleware::class,
    ];
    public $router;
    public function __construct(){
        $this->router = new Router();
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
        foreach($this->middleware as $middleware){
            if($error instanceof Response){
                return $error;
            }
            $error = $middleware($request);
        }
    }

}
<?php

namespace App\Http;

use bootstrap\App;
use App\Base\Model;
use helpers\MySqli;
use App\Base\Router;
use App\Models\User;
use App\Base\Response;

class Kernel {
    public $middleware = [ 
        \App\Middleware\VerbMiddleware::class,
        \App\Middleware\ParamMiddleware::class,
    ];
    public $router;
    public $app;
    public function __construct(App $app, Router $router) {
        $user = new User();
        $users = User::all();
        var_dump($user);
        dd("stop"); 
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
        foreach($this->middleware as $middleware){
            if($error instanceof Response){
                return $error;
            }
            $error = $middleware($request);
        }
    }

}
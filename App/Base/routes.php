<?php

namespace App\Base;

use App\Base\Route;
use App\Http\Controllers\BaseController;

class Routes {
    public $routes = [];
    public function __construct() {
        $this->addRoute(Route::get('/',BaseController::class,'index'));
        $this->addRoute(Route::get('/test',BaseController::class,'list'));
        $this->addRoute(Route::get('/testT',BaseController::class,'view'));
        return $this;
    }
    public function addRoute($route) {
        $this->routes[$route->uri] = $route;
    }
}
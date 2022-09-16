<?php

namespace routes;

use App\Base\Route;
use App\Http\Controllers\BaseController;

class Routes {
    public $routes = [];
    public function __construct() {
        $this->addRoute(Route::get('/',BaseController::class,'index'));
        $this->addRoute(Route::get('/migrate',BaseController::class,'migrate'));
        $this->addRoute(Route::get('/insert',BaseController::class,'insert'));
        return $this;
    }
    public function addRoute($route) {
        $this->routes[$route->uri] = $route;
    }
}
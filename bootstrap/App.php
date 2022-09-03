<?php

namespace bootstrap;

use App\Http\Kernel;

class App {
    public function __construct() {
        
    }
    public function make() {

        return new Kernel();
    }
}
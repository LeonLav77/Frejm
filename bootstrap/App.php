<?php

namespace bootstrap;

use App\Base\Router;
use App\Http\Kernel;

class App {
    public $config;
    public function __construct() {
        $this->registerConfig();
        $this->registerProviders();
        $this->bootProviders();
    }
    public function make() {
        
        return new Kernel($this, new Router());
    }
    public function registerConfig() {
        $path = '../config';
        $files = scandir($path);
        $files = array_diff(scandir($path), array('.', '..'));
        foreach($files as $file){
            $file = str_replace('.php', '', $file);
            $this->config[$file] = require_once "../config/$file.php";
        }
    }
    public function registerProviders(){
        foreach($this->config['app']['providers'] as $provider){
            $provider = new $provider($this);
            $provider->register();
        }
    }
    public function bootProviders(){
        foreach($this->config['app']['providers'] as $provider){
            $provider = new $provider($this);
            $provider->boot();
        }
    }
}
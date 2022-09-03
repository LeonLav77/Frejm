<?php

namespace App\Base;

class Request {

    public $uri;
    public $fullUri;
    public $method;
    public $params;
    public $server;

    public function __construct(){
        $this->fullUri = $_SERVER['REQUEST_URI'];
        $this->uri = '/'.explode('/', $this->fullUri)[3];

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = $_REQUEST;
        $this->server = $_SERVER;

    }
}
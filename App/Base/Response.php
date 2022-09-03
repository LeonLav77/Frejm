<?php

namespace App\Base;

class Response {
    
        public $data;
    
        public function __construct($data){
            $this->data = $data;
        }
    
}
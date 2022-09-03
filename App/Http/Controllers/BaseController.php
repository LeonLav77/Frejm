<?php

namespace App\Http\Controllers;

use App\Base\Request;

class BaseController{
    public function index(Request $request){
        return $request;
    }
}
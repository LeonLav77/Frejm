<?php

namespace App\Middleware;

use Closure;

class VerbMiddleware
{
    public function __invoke($request) : object
    {

        if ($request->method === "GET") {
            return $request;
            // next 
        }
        
        return response("request is not a GET request");
    }
}
<?php

namespace App\Http\Middleware;

use Closure;

class TestMiddleware
{
    public function __invoke($request) : object
    {

        if (true) {
            return $request;
        }
        
        return response("Did not pass TestMiddleware");
    }
}
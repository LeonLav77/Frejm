<?php

namespace App\Http\Middleware;

class ParamMiddleware
{
    public function __invoke($request)
    {
        return $request;
    }
}
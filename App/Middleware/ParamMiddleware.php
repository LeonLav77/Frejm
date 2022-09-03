<?php

namespace App\Middleware;

class ParamMiddleware
{
    public function __invoke($request)
    {
        return $request;
    }
}
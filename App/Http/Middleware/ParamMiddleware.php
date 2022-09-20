<?php

namespace App\Http\Middleware;

class ParamMiddleware
{
    public function __invoke($request)
    {
        $request->params = $request->params ?? [];
        return $request;
    }
}
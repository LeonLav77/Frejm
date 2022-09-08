<?php

return [
    'name' => env('APP_NAME', 'My App'),
    'version' => env('APP_VERSION', '1.0.0'),
    'providers' => [
        \App\Providers\AppServiceProvider::class,
        \App\Providers\RouteServiceProvider::class,
    ],
];
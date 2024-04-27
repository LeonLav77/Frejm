<?php

require "../vendor/autoload.php";

use Leonlav77\Frejmcore\Base\Request;


$request = new Request(); // the request object
$app = require_once __DIR__ . '/../bootstrap/app.php'; // usually there would be another step for instanciating a few more singletons

$kernel = $app->make(); // puts the kernel inside service container
$response = $kernel->handle($request); // request goes into the kernel and outputs a response
echo $response;
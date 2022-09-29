<?php

// require "autoload.php";
// require "../helpers/helpers.php";
require "../vendor/autoload.php";

use bootstrap\App;
use Leonlav77\Frejmcore\Base\Request;

$request = new Request(); // the request object
$app = new App(); // usually there would be another step for instanciating a few more singletons

$kernel = $app->make(); // puts the kernel inside service container
$response = $kernel->handle($request); // request goes into the kernel and outputs a response

var_dump($response);
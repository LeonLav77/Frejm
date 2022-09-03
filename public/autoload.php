<?php


spl_autoload_register(function ($class) {
    $file = $_SERVER['DOCUMENT_ROOT'] . '\Frejm/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }else {
        echo 'File not found: ' . $file;
    }
});
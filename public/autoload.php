<?php


spl_autoload_register(function ($class) {
    $file = baseDir() . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }else {
        echo 'File not found: ' . $file;
    }
});
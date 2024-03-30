<?php

use Leonlav77\Frejmcore\Base\Response;
use Leonlav77\Frejmcore\helpers\DotEnv;
function enhancedDump($data, $exit = true) {
    echo '<style>
            body { font-family: Arial, sans-serif; font-size: 14px; }
            .dump-wrapper { padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; background: #F9F9F9; }
            .dump-title { padding: 5px; background-color: #F2F2F2; border-bottom: 1px solid #ddd; }
            .dump-array-key { color: #008B8B; }
            .dump-boolean-true { color: green; }
            .dump-boolean-false { color: red; }
            .dump-string { color: #DD1144; }
            .dump-number { color: #0000FF; }
        </style>';

    function recursiveDump($data, $level = 0) {
        if ($level > 10) { // Limit recursion to prevent deep nesting issues
            echo 'Nesting level too deep';
            return;
        }

        if (is_null($data)) {
            echo '<i class="dump-null">NULL</i>';
        } elseif (is_bool($data)) {
            echo $data ? '<span class="dump-boolean-true">true</span>' : '<span class="dump-boolean-false">false</span>';
        } elseif (is_array($data)) {
            if (count($data) == 0) {
                echo '<i class="dump-array-empty">Empty array</i>';
            } else {
                echo '<div class="dump-wrapper">';
                foreach ($data as $key => $value) {
                    echo '<div class="dump-title"><span class="dump-array-key">' . htmlspecialchars($key) . '</span></div>';
                    echo '<div class="dump-content">';
                    recursiveDump($value, $level + 1);
                    echo '</div>';
                }
                echo '</div>';
            }
        } elseif (is_string($data)) {
            echo '<span class="dump-string">"' . htmlspecialchars($data) . '"</span>';
        } elseif (is_numeric($data)) {
            echo '<span class="dump-number">' . $data . '</span>';
        } elseif (is_object($data)) {
            $objectVars = get_object_vars($data);
            if (empty($objectVars)) {
                echo '<i class="dump-object-empty">Empty object (' . get_class($data) . ')</i>';
            } else {
                echo '<div class="dump-wrapper">';
                echo '<div class="dump-title"><span class="dump-object-class">' . get_class($data) . '</span></div>';
                recursiveDump($objectVars, $level + 1);
                echo '</div>';
            }
        } else {
            echo '<i class="dump-unknown">Unknown type</i>';
        }
    }

    recursiveDump($data);

    if ($exit) {
        exit;
    }
}

function response($data){
    return new Response($data);
}
function config($config){
    $config = explode(".", $config);
    $file = $config[0];
    $configFile = require "config/$file.php";
    return $configFile[$config[1]];
}
function env($key, $default = null){
    (new DotEnv(baseDir() . '.env'))->load();
    return getenv($key) ? getenv($key) : $default;
}
function baseDir(){
    return __DIR__ . "/../../";
}
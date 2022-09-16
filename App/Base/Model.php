<?php

namespace App\Base;

use App\Traits\HasEloquent;
use database\base\ConnectionInterface;

abstract class Model extends HasEloquent {

    public $table;
    public static $conn;

    public function __construct($class) {
       $className = get_class($class);
       $this->table = strtolower(substr($className, strrpos($className, '\\') + 1)) . 's';
    }
    public static function setConnection(ConnectionInterface $conn) {
        self::$conn = $conn;
    }
    public function setAttribute($name, $value) {
        $this->$name = $value;
    }
}
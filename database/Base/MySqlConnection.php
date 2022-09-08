<?php

namespace database\Base;

use mysqli;
use database\Base\ConnectionInterface;

class MySqlConnection implements ConnectionInterface {
    public $connection;
    public function __construct() {
        $this->connect();
    }
    public function connect() {
        $this->connection = new mysqli(
            getenv('DB_HOST'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD'),
            getenv('DB_DATABASE')
        );
    }
    public function query($query) {
        return $this->connection->query($query);
    }
}
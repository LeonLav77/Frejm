<?php

namespace database\base;

interface ConnectionInterface {
    public function connect();
    public function query($query);
}
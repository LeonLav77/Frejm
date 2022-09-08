<?php

namespace database\Base;

class Blueprint {
    public $table;
    public $columns = [];
    public $currentColumn;
    public function __construct($table) {
        $this->table = $table;
    }
    // public function id($column) {
    //     $this->columns[] = $column . ' INT(11) AUTO_INCREMENT';
    // }
    public function id() {
        $this->currentColumn = 'id';
        $this->columns['id'] = ' INT(11) AUTO_INCREMENT PRIMARY KEY';
        return $this;
    }
    public function string($column, $length = 255) {
        $this->currentColumn = $column;
        $this->columns[$column] =  ' VARCHAR('. $length .') ';
        return $this;
    }
    public function integer($column) {
        $this->currentColumn = $column;
        $this->columns[$column] =  ' INT(11) ';
        return $this;
    }
    public function unique(){
        $newAttributes = end($this->columns) . ' UNIQUE';
        $this->columns[$this->currentColumn] = $newAttributes;
        return $this;
    }
    public function required() {
        $newAttributes = end($this->columns) . ' NOT NULL';
        $this->columns[$this->currentColumn] = $newAttributes;
        return $this;
    }
}
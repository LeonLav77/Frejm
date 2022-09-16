<?php

namespace App\Traits;

use App\Base\Model;
use database\Base\QueryExcecutor;

abstract class HasEloquent {
    public static $DBTable;
    public static $where;
    public static $select;
    public static $limit;
    public static $orderBy;
    public static $query;
    public static function makeQuery(){
        $query = '';
        if (static::$select){
            $query .= "SELECT " . static::$select . ' FROM ' . static::$DBTable;
        }else{
            $query = "SELECT * FROM " . static::$DBTable;
        }
        if (static::$where){
            $query .= " WHERE " . static::$where;
        }
        if (static::$limit){
            $query .= " LIMIT " . static::$limit . ';';
        }
        if (static::$orderBy){
            $query .= " ORDER BY " . static::$orderBy;
        }
        static::$query = $query;
        $output = QueryExcecutor::execute($query, get_called_class());
        return $output;
    }
    public static function table($DBTable){
        self::$DBTable = $DBTable;
        return new static();
    }
    public static function where($condition, $operator, $value){
        self::$where = " {$condition} {$operator} '{$value}'";
        return new static();
    }
    public static function select(){
        $args = func_get_args();
        $query = '';
        foreach($args as $index => $arg){
            if($index == array_key_last($args)){
                $query .= $arg;
                continue;    
            }
            $query .= $arg . ',';
        }
        self::$select = $query;
        return new static();
    }

    // FINISHING METHODS
    public static function setUpTable(){
        if((new static) instanceof Model){
            self::$DBTable = (new static)->table;
        }
    }
    public static function first(){
        self::setUpTable();
        self::$limit = 1;
        $output = self::makeQuery();
        return $output[0];
    }
    public static function get(){
        $output = self::makeQuery();
        return $output;
    }
    public static function all(){
        self::setUpTable();
        self::$select = '*';
        $output = self::makeQuery();
        return $output;
    }
    public static function insert(){
        self::setUpTable();
        $args = func_get_args();
        if(count($args) == 1){
            $args = $args[0];
        }
        $columntNames = '';
        $values = '';
        foreach($args as $index => $arg){
            if($index == array_key_last($args)){
                $columntNames .= $index;
                $values .= "'{$arg}'";
                continue;    
            }
            $columntNames .= $index . ',';
            $values .= "'{$arg}',";
        }
        $query = "INSERT INTO " . static::$DBTable . " (" . $columntNames . ") VALUES (" . $values . ");";
        $output = QueryExcecutor::execute($query);
        return $output;
    }
}
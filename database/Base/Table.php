<?php

namespace database\Base;

use Closure;
use database\Base\MySqlConnection;

class Table
{
    public static function create($table,Closure $callback)
    {
        // we have a callback that has several parameters,
        // they can have many parameters, and we need to pass them to the callback
        
        // we need to create a new instance of the blueprint class
        $blueprint = new Blueprint($table);
        // we need to pass the blueprint instance to the callback
        $callback($blueprint);
        foreach($blueprint->columns as $name => $attributes) {
            $sql[] = $name . $attributes;
        }
        $sql = implode(',',$sql);
        $sql = "CREATE TABLE IF NOT EXISTS $table ($sql)";
        // dd($sql);        
        // dd($blueprint->columns);

        return (new MySqlConnection)->query($sql);
    }
    public function drop($table){
        $sql = "DROP TABLE IF EXISTS $table";
        return (new MySqlConnection)->query($sql);
    }
}
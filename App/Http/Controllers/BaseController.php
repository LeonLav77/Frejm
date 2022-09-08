<?php

namespace App\Http\Controllers;

use App\Base\Request;

class BaseController{
    public function index(Request $request){
        return $request;
    }
    public function migrate(){
        $migrations = scandir(__DIR__ . "\..\..\..\database\migrations");
        $migrations = array_filter($migrations, function($migration){
            return $migration != "." && $migration != "..";
        });
        $migrations = array_map(function($migration){
            return "database\\migrations\\" . str_replace(".php", "", $migration);
        }, $migrations);
        foreach($migrations as $migration){
            $migration = new $migration;
            $migration();
        }
        dd($migration);

    }
}
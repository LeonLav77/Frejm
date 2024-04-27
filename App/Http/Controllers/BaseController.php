<?php

namespace App\Http\Controllers;

use App\Models\User;
use database\Base\DB;
use Leonlav77\Frejmcore\Base\Request;

class BaseController{
    public function index(Request $request){
        
        return "Hello World!";
    }

    public function migrate(){
        $migrations = scandir(baseDir() . "\database\migrations");
        $migrations = array_filter($migrations, function($migration){
            return $migration != "." && $migration != "..";
        });
        $migrations = array_map(function($migration){
            $className = "Database\\Migrations\\" . str_replace(".php", "", ucfirst($migration));

            return $className;
        }, $migrations);
        foreach($migrations as $migration){
            $migration = new $migration;
            $migration();
        }

    }
}
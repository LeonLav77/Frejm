<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Base\Request;
use database\Base\DB;

class BaseController{
    public function index(Request $request){
        // $user = DB::table('users')->get();
        // $user = DB::table('users')->select('name', 'email')->where('name','=', 'John')->first();
        $user = User::first();
        return $user;
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

    }
}
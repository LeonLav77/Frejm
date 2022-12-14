<?php

namespace App\Http\Controllers;

use App\Models\User;
use database\Base\DB;
use Leonlav77\Frejmcore\Base\Request;

class BaseController{
    public function index(Request $request){
        // $user = DB::table('users')->get();
        // $user = DB::table('users')->select('name', 'email','id')->where('name','=', 'John')->first();
        $user = User::first();
        return $user;
    }
    public function insert(Request $request){
        $user = User::insert([
            'name' => 'Johnied',
            'email' => 'leonlavi77@gmail.com',
            'password' => '123456'
        ]);
        $user = User::first();
        // $user->name = 'Johnied1';
        // $user->save();
        return $user;
    }

    public function migrate(){
        $migrations = scandir(baseDir() . "\database\migrations");
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
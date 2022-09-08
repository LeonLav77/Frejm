<?php

namespace App\Providers;

use App\Base\Model;
use App\Traits\HasDB;
use database\Base\MySqlConnection;

class AppServiceProvider extends ServiceProvider {
    public function register() {
        // Register the database connection
        $this->app->bind('database', new MySqlConnection());
        Model::setConnection($this->app->database);
    }
    public function boot(){

    }
}
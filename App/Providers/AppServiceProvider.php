<?php

namespace App\Providers;

use App\Base\Model;
use database\Base\QueryExcecutor;
use database\Base\MySqlConnection;

class AppServiceProvider extends ServiceProvider {
    public function register() {
        // Register the database connection
        $this->app->bind('database', new MySqlConnection());
        Model::setConnection($this->app->database);
        QueryExcecutor::setConnection($this->app->database);
    }
    public function boot(){

    }
}
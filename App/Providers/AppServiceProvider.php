<?php

namespace App\Providers;

use Leonlav77\Frejmcore\Base\Model;
use Leonlav77\Frejmcore\database\Base\QueryExcecutor;
use Leonlav77\Frejmcore\database\Base\MySqlConnection;

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
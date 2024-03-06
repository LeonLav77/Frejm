<?php

namespace database\migrations;

use Leonlav77\Frejmcore\Base\Migration;
use Leonlav77\Frejmcore\database\Base\Table;
use Leonlav77\Frejmcore\database\Base\Blueprint;

class create_users_table extends Migration{
    public function up(){
        echo "Creating users table...\n";
        // NULLABLE BY DEFAULT
        Table::create('users', function(Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->string('email');
            $table->string('password');
        });
    }
    public function down(){
        Table::drop('users');
    }
}
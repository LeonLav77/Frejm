<?php

namespace database\migrations;

use App\Base\Migration;
use database\Base\Table;
use database\Base\Blueprint;

class create_users_table extends Migration{
    public function up(){
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
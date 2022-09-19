<?php

namespace database\migrations;

use App\Base\Migration;
use database\Base\Table;
use database\Base\Blueprint;

class create_trains_table extends Migration{
    public function up(){
        // NULLABLE BY DEFAULT
        Table::create('trains', function(Blueprint $table){
            $table->id();
        });
    }
    public function down(){
        Table::drop('trains');
    }
}
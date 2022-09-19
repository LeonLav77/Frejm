<?php

namespace console;

use console\MakeFile;
use database\Base\DB;

class Command {
    public $command;
    public $args = [];
    public $makeable_classes = [
        'controller',
        'model',
        'migration',
        'middleware',
    ];
    public function __construct($input) {
        $input = array_slice($input, 1, 2);
        if (count($input) == 0) {
            $this->command = 'help';
            return;
        }
        $this->command = $input[0];
        $input = array_slice($input, 1, 2);
        if (count($input) > 0) {
            foreach ($input as $arg) {
                $this->args[] = $arg;
            }
        }
    }

    public function run(){
        $command = $this->parseCommand($this->command);
        $commandName  = $command['name'];
        $commandArg = $command['arg'];
        try {
            $this->$commandName($commandArg);
        } catch (\Throwable $th) {
            echo "Command {} does not exist.\n";
        }
    }

    public function parseCommand($command){  
        $command = explode(':', $command);
        if(count($command) == 1){
            $commandName = $command[0];
            $commandArg = null;
        }else {
            $commandName = $command[0];
            $commandArg = $command[1];
        }
        return [
            'name' => $commandName,
            'arg' => $commandArg
        ];
    }

    public function help($arg = null){
        echo "This is help command. It will show you all available commands.\n";
    }
    public function migrate($arg = null){
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
        echo "Migrated";
    }
    public function make($arg = null){
        if($arg == null || !in_array($arg, $this->makeable_classes) || !isset($this->args[0])){	
            echo "This is make command. It will make new file. Don't forget the name of the file\n";
            echo "Available args: controller, model, migration, route\n";
            return;
        }
        MakeFile::$arg($this->args[0]);
    }
}
<?php

namespace console;

class MakeFile {
    public static function controller($name){
        if (file_exists('app/Http/Controllers/'. $name .'.php')) {
            echo "Controller already exists.\n";
            return;
        }
        fopen('app/Http/Controllers/'. $name .'.php', 'w');
        $template = file_get_contents('templates/controller_template.txt');
        $template = str_replace('{$name}', $name, $template);
        file_put_contents('app/Http/Controllers/'. $name .'.php', $template);
        echo "Controller created.\n";

        // echo "This is controller command {$name}. It will create controller file.\n";
    }
    public static function model($name){
        if (file_exists('app/Http/Models/'. $name .'.php')) {
            echo "Controller already exists.\n";
            return;
        }
        fopen('app/Http/Models/'. $name .'.php', 'w');
        $template = file_get_contents('templates/model_template.txt');
        $template = str_replace('{$name}', $name, $template);
        file_put_contents('app/Http/Models/'. $name .'.php', $template);
        echo "Model created.\n";
    }
    public static function migration($name){
        if (file_exists('database/migration/'. $name .'.php')) {
            echo "Migration already exists.\n";
            return;
        }
        $table = self::getTableName($name);
        var_dump ($table);
        fopen('database/migrations/'. $name .'.php', 'w');
        $template = file_get_contents('templates/migration_template.txt');
        $template = str_replace('{$name}', $name, $template);
        $template = str_replace('{$table}', $table, $template);
        file_put_contents('database/migrations/'. $name .'.php', $template);
        echo "Migration created.\n";
    }
    public static function middleware($name){
        fopen('app/Http/Controllers/'. $name .'.php', 'w');
        $template = file_get_contents('templates/controller_template.txt');
        $template = str_replace('{$name}', $name, $template);
        file_put_contents('app/Http/Controllers/'. $name .'.php', $template);
        echo "This is middleware command. It will create middleware file.\n";
    }
    public static function getTableName($name){
        $name = strtolower($name);
        $newName = explode('_', $name);
        if(count($newName) == 3){
            return $newName[1];
        }
        return $name;
    }
}
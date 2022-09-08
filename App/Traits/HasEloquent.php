<?php

namespace App\Traits;

trait HasEloquent {
    public static function all() {
        $model = new static;
        $sql = "SELECT * FROM {$model->table}";
        $output = parent::$conn->query($sql);
        $result = \helpers\MySqli::standardizeOutput($output);
        foreach($result as $key => $value){
            $newModel = new static($value);
            foreach($value as $attributeName => $attributeValue){
                $newModel->setAttribute($attributeName, $attributeValue);
            }
            $result[$key] = $newModel;
            // $result[$key] = ;
        }
        return $result;
    }
    public static function first(){
        $model = new static;
        $sql = "SELECT * FROM {$model->table} LIMIT 1";
        $output = parent::$conn->query($sql);
        $result = \helpers\MySqli::standardizeOutput($output);
        $newModel = new static($result[0]);
        foreach($result[0] as $attributeName => $attributeValue){
            $newModel->setAttribute($attributeName, $attributeValue);
        }
        return $newModel;
    }
}
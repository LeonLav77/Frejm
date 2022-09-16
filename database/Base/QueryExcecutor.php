<?php
namespace database\Base;

use stdClass;
use App\Base\Model;
use database\base\ConnectionInterface;

class QueryExcecutor{
    public static $conn;
    public static function execute($query, $model = 'stdClass'){
        try {
            $output = self::$conn->query($query);
          } catch ( \Exception $e ) {
            echo $e->getMessage();
            die();
          }
        if(gettype($output) == 'boolean'){
            return $output;
        }
        $result = \helpers\MySqli::standardizeOutput($output);
        $result = self::convertToModel($result, $model);
        return $result;
    }
    private static function convertToModel($input, $model = 'stdClass'){
        $output = [];
        foreach($input as $key => $value){
            $newModel = new $model();
            foreach($value as $attributeName => $attributeValue){
                if($newModel instanceof Model){
                    $newModel->setAttribute($attributeName, $attributeValue);
                    continue;
                }
                $newModel->$attributeName = $attributeValue;
            }
            $output[$key] = $newModel;
        }
        return $output;
    }
    
    public static function setConnection(ConnectionInterface $conn) {
        self::$conn = $conn;
    }
}
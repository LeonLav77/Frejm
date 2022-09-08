<?php

namespace helpers;

class MySqli {
    public static function standardizeOutput($query){
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}
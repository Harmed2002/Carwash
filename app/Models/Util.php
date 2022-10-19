<?php

namespace App\Models;

class Util {
    public static function upload($route,$fileName,$file) {
  
        // str_replace( '/', '', $route);
        $path = $file->storeAs($route,$fileName);

        return $path;
    }
}

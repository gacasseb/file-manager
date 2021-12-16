<?php

namespace app\models\core;

class FileParser
{
    public function loadData($columns = [])
    {
        if ( !empty($columns) ) {
            // Lê as colunas e salva na variável
        }
    }

    public static function encode($values)
    {
        $row = "";
    
        if ( !empty($values) ) {
            $row = implode(",", $values);
        }

        return $row . "\n";
    }

    public static function decode($row)
    {
        $values = [];

        if ( !empty($row) ) {
            $values = explode(",", $row);
        }

        return $values;
    }
}
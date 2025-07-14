<?php

class Database{

    private static $_database;
    public $sql;
    public $errors;
    
    private function __construct(){
        
    }

    public static function getInstance(){
        if(empty(self::$_database)){
            self::$_database = new Database();
        }
        return self::$_database;
    }



}

?>
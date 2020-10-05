<?php

final class TConnection {

    public function __construct() {
        
    }
    
    public static function open($nome = "projeto01"){
    
        $user = "root";
        //$pass = "root";
        $pass = "";
        $name = "projeto01";
        $host = "localhost";
        $tipo = "mysql";
        $port = "3306";
                
        switch($tipo){
            case 'mysql':
                $port = $port ? $port : '3306';
                $conn = new PDO("mysql:host={$host};dbname={$name}", $user, $pass);
                break;
        }
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $conn;
    }
}

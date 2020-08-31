<?php


final class TTransaction {
    private static $conn;
    
    /*
     não existirão instâncias de TConnection, por isso estamos marcando-o como private
     */
    private function __construct() {
        
    }
    
    public static function open($nome = 'projeto01'){

        if(empty(self::$conn)){

            self::$conn = TConnection::open($nome);
            self::$conn->beginTransaction();
        }
    }
    
    public static function get(){

        return self::$conn;
    }
    
    public static function rollback(){
        if(self::$conn){
            
            self::$conn->rollback();
            self::$conn = NULL;
        }
    }
    
    public static function close(){
        if(self::$conn){

            self::$conn->commit();
            self::$conn = NULL;
        }
    }
}

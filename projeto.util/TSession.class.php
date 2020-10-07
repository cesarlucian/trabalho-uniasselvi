<?php

class TSession {

    public function __construct(){

        session_set_cookie_params(900);
        session_start();

        if($this->getValue("usuario") == ""){
            header("location: http://localhost/trabalho-uniasselvi/");
        }
    }
    
    public static function setValue($var, $value){
        $_SESSION[$var] = $value;
    }
    
    public static function getValue($var){
        if(isset($_SESSION[$var])){
            return $_SESSION[$var];
        }

        return false;
    }
    
    public static function freeSession(){
        $_SESSION = array();
        session_destroy();
    }
}

?>
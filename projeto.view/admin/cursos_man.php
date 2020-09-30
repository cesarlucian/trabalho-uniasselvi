<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){
        
        case '':
            echo "teste";
        break;
    }
}



?>
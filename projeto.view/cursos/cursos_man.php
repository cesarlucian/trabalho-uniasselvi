<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){
        
        case 'novo_curso':
            echo "teste novo curso";
        break;

        case 'edita_curso':
        	echo "teste edita curso";
        break;
    }
}



?>
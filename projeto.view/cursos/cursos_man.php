<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){
        
        case 'novo_curso':
        
            print $ds_curso;

            echo "<br><br>";
        break;

        case 'edita_curso':
        	echo "teste edita curso";
        break;
    }
}



?>
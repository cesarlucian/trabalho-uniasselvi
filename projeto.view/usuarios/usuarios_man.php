<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){
        case 'nova_senha':
            echo 'ds_email-'.$ds_email;
            echo "<br>";
            echo 'ds_login-'.$ds_login;
        break;

        case 'nova_senha':
            echo "novo_usuario";
        break;
    }
}



?>
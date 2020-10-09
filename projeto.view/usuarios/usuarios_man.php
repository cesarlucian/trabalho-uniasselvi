<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){

        case 'novo_usuario':
            echo "novo_usuario";
        break;

        case 'edita_usuario':
            echo "edita usuario";
        break;

        case 'excluir_usuario':
            echo "excluir usuario";
        break;

        case 'nova_senha':
            echo 'ds_email-'.$ds_email;
            echo "<br>";
            echo 'ds_login-'.$ds_login;
        break;

        case 'novo_nome_usuario':
            echo "novo_nome_usuario";
        break;

        case 'gera_nova_senha':
            echo "gera nova senha";
        break;
    }
}



?>
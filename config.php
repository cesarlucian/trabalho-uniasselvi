<?php

session_start();

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

date_default_timezone_set('America/Sao_Paulo');

include_once("projeto.view/alunos/carregarAlunos.php");

spl_autoload_register(function ($classe){

    if(file_exists("projeto.util/{$classe}.class.php")){
        include_once "projeto.util/{$classe}.class.php";
    }
    else if(file_exists("projeto.control/{$classe}.class.php")){
        include_once "projeto.control/{$classe}.class.php";
    }
    else if(file_exists("projeto.model/{$classe}.php")){
        include_once "projeto.model/{$classe}.php";
    }
    else if(file_exists("projeto.view/{$classe}.class.php")){
        include_once "projeto.view/{$classe}.class.php";
    }
});

spl_autoload_register(function ($classe){
    if(file_exists("../projeto.util/{$classe}.class.php")){
        include_once "../projeto.util/{$classe}.class.php";
    }
    else if(file_exists("../projeto.control/{$classe}.class.php")){
        include_once "../projeto.control/{$classe}.class.php";
    }
    else if(file_exists("../projeto.model/{$classe}.php")){
        include_once "../projeto.model/{$classe}.php";
    }
    else if(file_exists("../projeto.view/{$classe}.class.php")){
        include_once "../projeto.view/{$classe}.class.php";
    }
});

spl_autoload_register(function ($classe){
    if(file_exists("../../projeto.util/{$classe}.class.php")){
        include_once "../../projeto.util/{$classe}.class.php";
    }
    else if(file_exists("../../projeto.control/{$classe}.class.php")){
        include_once "../../projeto.control/{$classe}.class.php";
    }
    else if(file_exists("../../projeto.model/{$classe}.php")){
        include_once "../../projeto.model/{$classe}.php";
    }
    else if(file_exists("../../projeto.view/{$classe}.class.php")){
        include_once "../../projeto.view/{$classe}.class.php";
    }
});

spl_autoload_register(function ($classe){
    if(file_exists("../../../projeto.util/{$classe}.class.php")){
        include_once "../../../projeto.util/{$classe}.class.php";
    }
    else if(file_exists("../../../projeto.control/{$classe}.class.php")){
        include_once "../../../projeto.control/{$classe}.class.php";
    }
    else if(file_exists("../../../projeto.model/{$classe}.php")){
        include_once "../../../projeto.model/{$classe}.php";
    }
    else if(file_exists("../../../projeto.view/{$classe}.class.php")){
        include_once "../../../projeto.view/{$classe}.class.php";
    }
});







?>
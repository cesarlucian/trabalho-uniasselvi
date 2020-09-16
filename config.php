<?php

ini_set('display_errors', 'off');
error_reporting(E_ALL | E_STRICT);

date_default_timezone_set('America/Sao_Paulo');

//include_once("projeto.view". DIRECTORY_SEPARATOR ."alunos". DIRECTORY_SEPARATOR ."carregarAlunos.php");

spl_autoload_register(function ($classe){

    if(file_exists("projeto.util". DIRECTORY_SEPARATOR ."{$classe}.class.php")){
        include_once "projeto.util". DIRECTORY_SEPARATOR ."{$classe}.class.php";
    }
    else if(file_exists("projeto.control". DIRECTORY_SEPARATOR ."{$classe}.class.php")){
        include_once "projeto.control". DIRECTORY_SEPARATOR ."{$classe}.class.php";
    }
    else if(file_exists("projeto.model". DIRECTORY_SEPARATOR ."{$classe}.php")){
        include_once "projeto.model". DIRECTORY_SEPARATOR ."{$classe}.php";
    }
    else if(file_exists("projeto.view". DIRECTORY_SEPARATOR ."{$classe}.class.php")){
        include_once "projeto.view". DIRECTORY_SEPARATOR ."{$classe}.class.php";
    }
});

spl_autoload_register(function ($classe){
    if(file_exists("..". DIRECTORY_SEPARATOR ."projeto.util". DIRECTORY_SEPARATOR ."{$classe}.class.php")){
        include_once "..". DIRECTORY_SEPARATOR ."projeto.util". DIRECTORY_SEPARATOR ."{$classe}.class.php";
    }
    else if(file_exists("..". DIRECTORY_SEPARATOR ."projeto.control". DIRECTORY_SEPARATOR ."{$classe}.class.php")){
        include_once "..". DIRECTORY_SEPARATOR ."projeto.control". DIRECTORY_SEPARATOR ."{$classe}.class.php";
    }
    else if(file_exists("..". DIRECTORY_SEPARATOR ."projeto.model". DIRECTORY_SEPARATOR ."{$classe}.php")){
        include_once "..". DIRECTORY_SEPARATOR ."projeto.model". DIRECTORY_SEPARATOR ."{$classe}.php";
    }
    else if(file_exists("..". DIRECTORY_SEPARATOR ."projeto.view". DIRECTORY_SEPARATOR ."{$classe}.class.php")){
        include_once "..". DIRECTORY_SEPARATOR ."projeto.view". DIRECTORY_SEPARATOR ."{$classe}.class.php";
    }
});

spl_autoload_register(function ($classe){
    if(file_exists("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.util". DIRECTORY_SEPARATOR ."{$classe}.class.php")){
        include_once "..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.util". DIRECTORY_SEPARATOR ."{$classe}.class.php";
    }
    else if(file_exists("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.control". DIRECTORY_SEPARATOR ."{$classe}.class.php")){
        include_once "..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.control". DIRECTORY_SEPARATOR ."{$classe}.class.php";
    }
    else if(file_exists("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.model". DIRECTORY_SEPARATOR ."{$classe}.php")){
        include_once "..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.model". DIRECTORY_SEPARATOR ."{$classe}.php";
    }
    else if(file_exists("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.view". DIRECTORY_SEPARATOR ."{$classe}.class.php")){
        include_once "..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.view". DIRECTORY_SEPARATOR ."{$classe}.class.php";
    }
});

spl_autoload_register(function ($classe){
    if(file_exists("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.util". DIRECTORY_SEPARATOR ."{$classe}.class.php")){
        include_once "..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.util". DIRECTORY_SEPARATOR ."{$classe}.class.php";
    }
    else if(file_exists("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.control". DIRECTORY_SEPARATOR ."{$classe}.class.php")){
        include_once "..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.control". DIRECTORY_SEPARATOR ."{$classe}.class.php";
    }
    else if(file_exists("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.model". DIRECTORY_SEPARATOR ."{$classe}.php")){
        include_once "..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.model". DIRECTORY_SEPARATOR ."{$classe}.php";
    }
    else if(file_exists("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.view". DIRECTORY_SEPARATOR ."{$classe}.class.php")){
        include_once "..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.view". DIRECTORY_SEPARATOR ."{$classe}.class.php";
    }
});







?>
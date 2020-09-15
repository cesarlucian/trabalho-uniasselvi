<?php

ini_set('display_errors', 'off');
error_reporting(E_ALL | E_STRICT);

include_once("../../config.php");

extract($_GET);

try{
    
    //str_replace('-','',$cep)

    $cep = str_replace("-", "", $cep);
 
    $json = file_get_contents('https://viacep.com.br/ws/'. $cep . '/json/');

    $dados_cep = json_decode($json);

    if(!empty($dados_cep)) {

    	echo $dados_cep->uf.';'.$dados_cep->localidade.';'.$dados_cep->bairro.';'.$dados_cep->logradouro;

    } else {

    	$dados_cep->uf = "";
    	$dados_cep->localidade = "";
    	$dados_cep->bairro = "";
    	$dados_cep->logradouro = "";

    	echo $dados_cep->uf.';'.$dados_cep->localidade.';'.$dados_cep->bairro.';'.$dados_cep->logradouro;
    }

    

  
} catch (Exception $ex) {

}

?>
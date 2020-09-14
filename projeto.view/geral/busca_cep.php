<?php

include_once("../../config.php");

extract($_GET);

try{
    
    //str_replace('-','',$cep)

    $cep = str_replace("-", "", $cep);
 
    $json = file_get_contents('https://viacep.com.br/ws/'. $cep . '/json/');

    $dados_cep = json_decode($json);

    echo $dados_cep->uf.';'.$dados_cep->localidade.';'.$dados_cep->bairro.';'.$dados_cep->logradouro;   
    
} catch (Exception $ex) {

}

?>
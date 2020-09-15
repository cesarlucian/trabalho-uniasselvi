<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){
        case 'novo_aluno':

        //echo "oi";exit;
        	
        	$novo_aluno = new Alunos();

        	if(!Geral::validaCPF($nr_cpf)) {

        		$msg_tipo = 2;
                $msg_texto = "CPF invalido ! Tente novamente.";
                header("location: cadastro.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao inserir aluno na base de dados, Erro: CPF Invalido - ".date("Y-m-d H:i:s")."\r\n");

        	} else if(!Geral::validaEmail($ds_email)) {

        		$msg_tipo = 2;
                $msg_texto = "Email invalido ! Tente novamente.";
                header("location: cadastro.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao inserir aluno na base de dados, Erro: Email invalido - ".date("Y-m-d H:i:s")."\r\n");

        	} else {

        		// dados cadastrais

        		$nova_matricula = rand(100000, 999999);

        		$novo_aluno->nm_principal   = $ds_nome;
	        	$novo_aluno->dt_nascimento  = $dt_nascimento;
	        	$novo_aluno->nr_cpf         = str_replace(array(".","-"), "", $nr_cpf);
	        	$novo_aluno->ds_email       = $ds_email;
	        	$novo_aluno->nr_matricula   = $nova_matricula;
	        	$novo_aluno->fg_status      = "A";
	        	$novo_aluno->cd_curso       = $cd_curso;

	        	// endereco

	        	$novo_aluno->nr_cep = str_replace("-", "", $nr_cep);
	        	$novo_aluno->ds_complemento = $ds_complemento;
	        	$novo_aluno->ds_uf = $ds_uf;
	        	$novo_aluno->ds_cidade = $ds_cidade;
	        	$novo_aluno->ds_bairro = $ds_bairro;
	        	$novo_aluno->ds_endereco = $ds_endereco;


	        	if($novo_aluno->insert()) {

	        		$msg_tipo = 1;
	                $msg_texto = "Aluno cadastrado com sucesso!";
	                header("location: cadastro.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

	        		$file = fopen("../../projeto.log/log.txt","a+");
	        		fwrite($file,"Foi inserido um novo aluno na base de dados - ".date("Y-m-d H:i:s")."\r\n");

	        	} else {

	        		$msg_tipo = 2;
	                $msg_texto = "Erro ao cadastrar aluno, tente novamente!";
	                header("location: cadastro.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

	        		$file = fopen("../../projeto.log/log.txt","a+");
	        		fwrite($file,"Erro ao cadastrar aluno na base de dados - ".date("Y-m-d H:i:s")."\r\n");

	        	}
        	}

        break;

    }
}



?>
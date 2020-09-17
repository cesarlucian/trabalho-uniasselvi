<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){
        case 'novo_aluno':

        	$aluno = new Alunos();

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

        		$aluno->nm_principal   = $ds_nome;
	        	$aluno->dt_nascimento  = $dt_nascimento;
	        	$aluno->nr_cpf         = str_replace(array(".","-"), "", $nr_cpf);
	        	$aluno->ds_email       = $ds_email;
	        	$aluno->nr_matricula   = $nova_matricula;
	        	$aluno->fg_status      = "A";
	        	$aluno->ds_sexo        = $ds_sexo;
	        	$aluno->cd_curso       = $cd_curso;

	        	// endereco

	        	$aluno->nr_cep = str_replace("-", "", $nr_cep);
	        	$aluno->ds_complemento = $ds_complemento;
	        	$aluno->ds_uf = $ds_uf;
	        	$aluno->nr_endereco    = $nr_endereco;
	        	$aluno->ds_cidade = $ds_cidade;
	        	$aluno->ds_bairro = $ds_bairro;
	        	$aluno->ds_endereco = $ds_endereco;


	        	if($aluno->insert()) {

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

        case 'edita_aluno':

        	$aluno = new Alunos();
        	$aluno->getObject($cd_aluno);
        	
        	if(!Geral::validaCPF($nr_cpf)) {

        		$msg_tipo = 2;
                $msg_texto = "CPF invalido ! Tente novamente.";
                header("location: edicao.php?cd_aluno=".$cd_aluno."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao editar aluno na base de dados, Erro: CPF Invalido - ".date("Y-m-d H:i:s")."\r\n");

        	} else if(!Geral::validaEmail($ds_email)) {

        		$msg_tipo = 2;
                $msg_texto = "Email invalido ! Tente novamente.";
                header("location: edicao.php?cd_aluno=".$cd_aluno."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao editar aluno na base de dados, Erro: Email invalido - ".date("Y-m-d H:i:s")."\r\n");

        	} else {

        		// dados cadastrais

        		$aluno->nm_principal   = $ds_nome;
	        	$aluno->dt_nascimento  = $dt_nascimento;
	        	$aluno->nr_cpf         = str_replace(array(".","-"), "", $nr_cpf);
	        	$aluno->ds_email       = $ds_email;
	        	$aluno->fg_status      = "A";
	        	$aluno->ds_sexo        = $ds_sexo;
	        	$aluno->cd_curso       = $cd_curso;

	        	// endereco

	        	$aluno->nr_cep = str_replace("-", "", $nr_cep);
	        	$aluno->ds_complemento = $ds_complemento;
	        	$aluno->ds_uf = $ds_uf;
	        	$aluno->nr_endereco    = $nr_endereco;
	        	$aluno->ds_cidade = $ds_cidade;
	        	$aluno->ds_bairro = $ds_bairro;
	        	$aluno->ds_endereco = $ds_endereco;


	        	if($aluno->update()) {

	        		$msg_tipo = 1;
	                $msg_texto = "Aluno alterado com sucesso!";
	                header("location: edicao.php?cd_aluno=".$cd_aluno."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

	        		$file = fopen("../../projeto.log/log.txt","a+");
	        		fwrite($file,"O aluno ID: '$cd_aluno' foi editado na base de dados - ".date("Y-m-d H:i:s")."\r\n");

	        	} else {
	        		
	        		$msg_tipo = 2;
	                $msg_texto = "Erro ao editar aluno, tente novamente!";
	                header("location: edicao.php?cd_aluno=".$cd_aluno."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

	        		$file = fopen("../../projeto.log/log.txt","a+");
	        		fwrite($file,"Erro ao editar aluno na base de dados - ".date("Y-m-d H:i:s")."\r\n");
	        	}
	        }
        break;

        case 'excluir':
        	
        	if(Alunos::delete($cd_aluno)){

                $msg_tipo = 1;
                $msg_texto = "Aluno excluido com sucesso!";
                header("location: consulta_alunos.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

        		$file = fopen("../../projeto.log/log.txt","a+");
        		fwrite($file,"O aluno ID: '$cd_aluno' foi excluido da base de dados - ".date("Y-m-d H:i:s")."\r\n");
            }
            else{
                $msg_tipo = 2;
                $msg_texto = "Erro ao excluir aluno, tente novamente!";
                header("location: consulta_alunos.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

        		$file = fopen("../../projeto.log/log.txt","a+");
        		fwrite($file,"Erro ao excluir aluno da base de dados - ".date("Y-m-d H:i:s")."\r\n");
            }

        break;
    }
}



?>
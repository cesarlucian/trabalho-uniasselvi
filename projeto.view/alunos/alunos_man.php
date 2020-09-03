<?php

include_once("../../config.php");

extract($_POST);
extract($_GET);

// evento é o nome do formulario enviado por POST nesse caso o formulario AlunosForm::novo() é novo_aluno o nome
// aqui ficara todos case com nome de seus formularios correspondentes , por exemplo case edita_aluno ... ai tera o codigo q vai dar update no aluno etc Poderia ser um metodo Alunos::edita()

if(isset($evento)){
    switch($evento){
        case 'novo_aluno':
        	
        	$novo_aluno = new Alunos();

        	if(Geral::isCpfValid($inputCpf)) {

        		$nova_matricula = rand(1000000, 9999999);

        		$novo_aluno->nm_principal   = $inputName;
	        	$novo_aluno->dt_nascimento  = $inputNascimento;
	        	$novo_aluno->nr_cpf         = str_replace(array(".","-"), "", $inputCpf);
	        	$novo_aluno->ds_email       = $inputEmail;
	        	$novo_aluno->ds_endereco    = $inputEndereco;
	        	$novo_aluno->ds_complemento = $inputComplemento;
	        	$novo_aluno->nr_matricula   = $nova_matricula;
	        	$novo_aluno->nr_cep         = str_replace("-","", $inputCep);
	        	$novo_aluno->fg_status      = "A";
	        	$novo_aluno->cd_curso       = $cd_curso;

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

        	} else {

        		$msg_tipo = 2;
                $msg_texto = "Erro ao cadastrar aluno, CPF invalido !";
                header("location: cadastro.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao inserir aluno na base de dados - ".date("Y-m-d H:i:s")."\r\n");
        	}

        break;

    }
}



?>
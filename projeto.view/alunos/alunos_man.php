<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){
        case 'novo_aluno':

        	$aluno = new Alunos();
        	$verifica = new Turmas();

        	if(!Geral::validaCPF($nr_cpf)) {

                ?>
                <script>
                    alert("CPF inv\u00e1lido!.");
                    history.back();
                </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao inserir aluno na base de dados, Erro: CPF Invalido - ".date("Y-m-d H:i:s")."\r\n");

        	} else if($aluno->verificaCpfAluno(str_replace(array(".","-"), "", $nr_cpf))) {

        		?>
                <script>
                    alert("CPF j\u00e1 cadastrado no sistema!");
                    history.back();
                </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao editar aluno na base de dados, Erro: CPF ja existe na base de dados - ".date("Y-m-d H:i:s")."\r\n");

        	} else if(!Geral::validaEmail($ds_email)) {

        		?>
                <script>
                    alert("Email inv\u00e1lido!");
                    history.back();
                </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao inserir aluno na base de dados, Erro: Email invalido - ".date("Y-m-d H:i:s")."\r\n");

        	} else if (!$verifica->verificaTurma($cd_curso,$cd_turma)) {

        		?>
                <script>
                    alert("Esta turma n\u00e3o pertence a este curso, altere a turma !");
                    history.back();
                </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao inserir aluno na base de dados, Erro: Turma não pertence ao curso - ".date("Y-m-d H:i:s")."\r\n");

        	} else {

        		// dados cadastrais

        		$nova_matricula = rand(100000, 999999);

        		$aluno->nm_principal   = $ds_nome;
	        	$aluno->dt_nascimento  = $dt_nascimento;
	        	$aluno->nr_cpf         = str_replace(array(".","-"), "", $nr_cpf);
	        	$aluno->ds_email       = $ds_email;
	        	$aluno->nr_matricula   = $nova_matricula;
	        	$aluno->ds_sexo        = $ds_sexo;
	        	$aluno->cd_turma       = $cd_turma;
	        	$aluno->cd_curso       = $cd_curso;
                $aluno->fg_status      = "A";

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
	                header("location: edicao.php?cd_aluno=".$aluno->cd_aluno."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

	        		$file = fopen("../../projeto.log/log.txt","a+");
	        		fwrite($file,"Foi inserido um novo aluno na base de dados - ".date("Y-m-d H:i:s")."\r\n");

	        	} else {

	        		?>
                        <script>
                            alert("Erro ao cadastrar aluno!");
                            history.back();
                        </script>
                    <?php

	        		$file = fopen("../../projeto.log/log.txt","a+");
	        		fwrite($file,"Erro ao cadastrar aluno na base de dados - ".date("Y-m-d H:i:s")."\r\n");

	        	}
        	}
        break;

        case 'edita_aluno':

        	$aluno = new Alunos();
        	$aluno->getObject($cd_aluno);

        	$verifica = new Turmas();
        	
        	if(!Geral::validaCPF($nr_cpf)) {

        		?>
                <script>
                    alert("CPF inv\u00e1lido!");
                    history.back();
                </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao editar aluno na base de dados, Erro: CPF Invalido - ".date("Y-m-d H:i:s")."\r\n");

        	} else if(str_replace(array(".","-"), "", $nr_cpf) != $aluno->nr_cpf & $aluno->verificaCpfAluno(str_replace(array(".","-"), "", $nr_cpf))) {

        		?>
                <script>
                    alert("CPF j\u00e1 cadastrado no sistema!");
                    history.back();
                </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao editar aluno na base de dados, Erro: CPF ja existe na base de dados - ".date("Y-m-d H:i:s")."\r\n");



        	} else if(!Geral::validaEmail($ds_email)) {

        		?>
                <script>
                    alert("Email inv\u00e1lido!");
                    history.back();
                </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao editar aluno na base de dados, Erro: Email invalido - ".date("Y-m-d H:i:s")."\r\n");

        	} else if (!$verifica->verificaTurma($cd_curso,$cd_turma)) {

        		?>
                <script>
                    alert("Esta turma n\u00e3o pertence a este curso, altere a turma !");
                    history.back();
                </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
	        	fwrite($file,"Erro ao inserir aluno na base de dados, Erro: Turma não pertence ao curso - ".date("Y-m-d H:i:s")."\r\n");

        	} else {

        		// dados cadastrais

        		$aluno->nm_principal   = $ds_nome;
	        	$aluno->dt_nascimento  = $dt_nascimento;
	        	$aluno->nr_cpf         = str_replace(array(".","-"), "", $nr_cpf);
	        	$aluno->ds_email       = $ds_email;
	        	$aluno->ds_sexo        = $ds_sexo;
	        	$aluno->cd_turma       = $cd_turma;
	        	$aluno->cd_curso       = $cd_curso;
                $aluno->fg_status      = $fg_status;

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
	                $msg_texto = "Aluno atualizado com sucesso!";
	                header("location: edicao.php?cd_aluno=".$cd_aluno."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

	        		$file = fopen("../../projeto.log/log.txt","a+");
	        		fwrite($file,"O aluno ID: '$cd_aluno' foi editado na base de dados - ".date("Y-m-d H:i:s")."\r\n");

	        	} else {
	        		
	        		?>
                        <script>
                            alert("Erro ao atualizar aluno!");
                            history.back();
                        </script>
                    <?php

	        		$file = fopen("../../projeto.log/log.txt","a+");
	        		fwrite($file,"Erro ao editar aluno na base de dados - ".date("Y-m-d H:i:s")."\r\n");
	        	}
	        }
        break;
    }
}



?>
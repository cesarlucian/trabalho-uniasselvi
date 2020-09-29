<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_GET);

$filtro   = @$_GET['filtro'];
$ds_sexo  = @$_GET['ds_sexo'];
$ds_aluno = @$_GET['ds_aluno'];
$ds_curso = @$_GET['ds_curso'];



$pag        = @$_GET['pag'];
$pesquisado = true;

switch ($filtro) {

	case '1':
		$desc_filtro = "Nome";
	break;

	case '2':
		$desc_filtro = "Curso";
	break;
}

switch ($ds_sexo) {
	case 'M':
		$desc_ds_sexo = "sexo Masculino";
	break;
	
	case 'F':
		$desc_ds_sexo = "sexo Feminino";	
	break;

	case 'O':
		$desc_ds_sexo = "sexo outros";	
	break;

	default:
		$desc_ds_sexo = "";
	break;
}


$file = fopen("../../projeto.log/log.txt","a+");
fwrite($file,"Foi realizada uma consulta dos alunos pelos filtros: $desc_filtro, $desc_ds_sexo, pesquisa: $filtro_pesquisa - ".date("Y-m-d H:i:s")."\r\n");

if($pag == ''){
    $pag = 1;
}

$pesquisa['filtro']   = $filtro;
$pesquisa['ds_aluno'] = $ds_aluno;
$pesquisa['ds_curso'] = $ds_curso;
$pesquisa['ds_sexo']  = $ds_sexo;

?>
		<?php include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."header.php"); ?>
		<?php include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."menu.php"); ?>
	                <section class="content">
						<?php 	
							if(isset($msg_tipo)){
					    		MensagemForm::exibir($msg_tipo, $msg_texto);
							}

	                        $alunos_form = new AlunosForm; 
	                        $alunos_form->pesquisa();
	                        
	                        $alunos_list = new AlunosList();
	                        if($pesquisado){
	                            $alunos_list->lista(Alunos::listaAlunosPag($filtro,$ds_sexo,$ds_aluno,$ds_curso, $pag), $pag,false);
	                        }
	                        else{
	                            $alunos_list->lista(null, $pag);
	                        }
	                    ?>

	                    <div class="paginador">
	                        <?= PaginadorForm::paginador($pesquisa, $pag); ?>
	                    </div>
	                </section>
        	

		<script src="../../js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
		<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."footer.php");

?>

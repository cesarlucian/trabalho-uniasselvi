<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_GET);

$cd_falta = @$_GET['cd_falta'];
$dt_falta = @$_GET['dt_falta'];
$cd_aluno = @$_GET['cd_aluno'];
$cd_turma = @$_GET['cd_turma'];
$cd_curso = @$_GET['cd_curso'];

$pag        = @$_GET['pag'];

if($pag == ''){
    $pag = 1;
}

$pesquisa['cd_falta'] = $cd_falta;
$pesquisa['dt_falta'] = $dt_falta;
$pesquisa['cd_aluno'] = $cd_aluno;
$pesquisa['cd_turma'] = $cd_turma;
$pesquisa['cd_curso'] = $cd_curso;


$pesquisado = true;

/*if($cd_aluno != "" || $dt_falta != "") {

	$pesquisado = true;
}*/

$desc_turma = new Turmas();
$desc_turma->getObject($cd_turma);

$file = fopen("../../projeto.log/log.txt","a+");
fwrite($file,"Foi realizada uma consulta das faltas justificadas - ".date("Y-m-d H:i:s")."\r\n");

?>
		<?php include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."header.php"); ?>
		<?php include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."menu.php"); ?>
	                <section class="content">
						<?php 	
							if(isset($msg_tipo)){
					    		MensagemForm::exibir($msg_tipo, $msg_texto);
							}

							$falta_form = new ChamadaForm();
							$falta_form->pesquisaFaltas();
							
							$falta_list = new ChamadaList;

	                        if($pesquisado){
	                        	
	                            $falta_list->listaFaltas(Chamada::listaFaltasPag($cd_aluno,$dt_falta,$pag),$pag,false);
	                        }
	                        else{
	                            $falta_list->listaFaltas(null, $pag);
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

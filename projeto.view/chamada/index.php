<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

new TSession();
extract($_GET);

$cd_curso             = @$_GET['cd_curso'];
$cd_turma             = @$_GET['cd_turma'];

$pesquisado = false;

$pesquisa['cd_curso'] = $cd_curso;
$pesquisa['cd_turma'] = $cd_turma;

if($cd_turma != "" & $cd_curso != "") {

	$pesquisado = true;
}

$desc_turma = new Turmas();
$desc_turma->getObject($cd_turma);

$file = fopen("../../projeto.log/log.txt","a+");
fwrite($file,"Foi realizada uma consulta dos alunos da turma ".$desc_turma->nr_turma." para realizar a chamada do dia: ".date("Y-m-d H:i:s")."\r\n");

?>
		<?php include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."header.php"); ?>
		<?php include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."menu.php"); ?>
	                <section class="content">
						<?php 	
							if(isset($msg_tipo)){
					    		MensagemForm::exibir($msg_tipo, $msg_texto);
							}

	                        $chamada_form = new ChamadaForm; 
	                        $chamada_form->pesquisaChamada();
	                        
	                        $chamada_list = new ChamadaList();
	                        if($pesquisado){
	                            $chamada_list->listaChamada(Alunos::listaAlunosChamada($cd_curso, $cd_turma));
	                        }
	                        
	                    ?>
	                </section>

	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>                        
		<script src="../../js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
		<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."footer.php");

?>

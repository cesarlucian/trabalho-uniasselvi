<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

new TSession();
extract($_GET);

$nr_turma        = @$_GET['nr_turma'];
$filtro_pesquisa = @$_GET['filtro_pesquisa']; 

$pag        = @$_GET['pag'];
$pesquisado = true;


$file = fopen("../../projeto.log/log.txt","a+");
fwrite($file,"Foi realizada uma consulta das turmas, pelo numero: $nr_turma - ".date("Y-m-d H:i:s")."\r\n");

if($pag == ''){
    $pag = 1;
}

$pesquisa['nr_turma']        = $nr_turma;
$pesquisa['filtro_pesquisa'] = $filtro_pesquisa;



?>
		<?php include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."header.php"); ?>
		<?php include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."menu.php"); ?>
	                <section>
						<?php 	
							if(isset($msg_tipo)){
					    		MensagemForm::exibir($msg_tipo, $msg_texto);
							}

	                        $turmas_form = new TurmasForm(); 
	                        $turmas_form->pesquisa();
	                        
	                        $turmas_list = new TurmasList();
	                        if($pesquisado){
	                            $turmas_list->lista(Turmas::listaTurmasPag($nr_turma,$filtro_pesquisa, $pag), $pag,false);
	                        }
	                        else{
	                            $alunos_list->lista(null, $pag);
	                        }
	                    ?>

	                    <div class="paginador">
	                        <?= PaginadorForm::paginador($pesquisa, $pag); ?>
	                    </div>
	                </section>
        	
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>            
		<script src="../../js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
		<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."footer.php");

?>

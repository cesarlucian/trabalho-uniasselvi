<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

new TSession();
extract($_GET);

$dt_falta = @$_GET['dt_falta'];
$filtro = @$_GET['filtro'];


$pag        = @$_GET['pag'];

if($pag == ''){
    $pag = 1;
}

$pesquisa['dt_falta'] = $dt_falta;
$pesquisa['filtro']   =  $filtro;

$pesquisado = true;

/*if($cd_aluno != "" || $dt_falta != "") {

	$pesquisado = true;
}*/

$file = fopen("../../projeto.log/log.txt","a+");
fwrite($file,"Foi realizada uma consulta das faltas justificadas, pela descricao: '$filtro', data: '$dt_falta' - ".date("Y-m-d H:i:s")."\r\n");

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
	                        	
	                            $falta_list->listaFaltas(Chamada::listaFaltasPag($filtro,$dt_falta,$pag),$pag,false);
	                        }
	                        else{
	                            $falta_list->listaFaltas(null, $pag);
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

<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_GET);

$filtro             = @$_GET['filtro'];
$ds_sexo            = @$_GET['ds_sexo'];
$filtro_pesquisa    = @$_GET['filtro_descricao'];

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

$pesquisa['filtro']           = $filtro;
$pesquisa['filtro_descricao'] = $filtro_pesquisa;
$pesquisa['ds_sexo']          = $ds_sexo;

?>
		<?php include_once("../../header.php"); ?>
		<?php include_once("../../menu.php"); ?>
	                <section class="content">
						<?php 	
							if(isset($msg_tipo)){
					    		MensagemForm::exibir($msg_tipo, $msg_texto);
							}

	                        $alunos_form = new AlunosForm; 
	                        $alunos_form->pesquisa();
	                        
	                        $alunos_list = new AlunosList();
	                        if($pesquisado){
	                            $alunos_list->lista(Alunos::listaAlunosPag($filtro,$ds_sexo,$filtro_pesquisa, $pag), $pag,false);
	                        }
	                        else{
	                            $alunos_list->lista(null, $pag);
	                        }
	                    ?>

	                    <div class="paginador">
	                        <?= PaginadorForm::paginador($pesquisa, $pag) ?>
	                    </div>
	                </section>
        	</div>

		<!-- jQuery 2.0.2 -->
		<script src="../../js/jquery-min.js"></script>

		<!-- jQuery UI 1.10.3 -->
		<script src="../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>

		<!-- Bootstrap -->
		<script src="../../js/bootstrap.min.js" type="text/javascript"></script>

		<!-- AdminLTE App -->
		<script src="../../dist/js/app.js" type="text/javascript"></script>

		<!-- Slimscroll -->
		<script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

		<!-- Input Mask -->
		<script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>

		<script type="text/javascript">
			$(function() {                
		      	//$("#inputNascimento").inputmask("99/99/9999");
		      	$("#nr_cpf").inputmask("999.999.999-99");
		      	$("#nr_cep").inputmask("99999-999");
		    });
		</script>
		<?php

include_once("../../footer.php");

?>

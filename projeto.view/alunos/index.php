<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

new TSession();
extract($_GET);

$filtro   = @$_GET['filtro'];
$pesquisa_filtro   = @$_GET['pesquisa_filtro'];

$pag        = @$_GET['pag'];
$pesquisado = true;

switch ($filtro) {

	case '1':
		$desc_filtro = "Nome";
	break;

	case '2':
		$desc_filtro = "Curso";
	break;

	default:
		$desc_filtro = "";
	break;
}



$file = fopen("../../projeto.log/log.txt","a+");
fwrite($file,"Foi realizada uma consulta dos alunos pelos filtros: $desc_filtro, pesquisa: $filtro - ".date("Y-m-d H:i:s")."\r\n");

if($pag == ''){
    $pag = 1;
}

$pesquisa['filtro']   = $filtro;
$pesquisa['pesquisa_filtro']  = $pesquisa_filtro;

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
	                            $alunos_list->lista(Alunos::listaAlunosPag($filtro,$pesquisa_filtro, $pag), $pag,false);
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
		<script type="text/javascript">
			$(function() {                
		      	//$("#inputNascimento").inputmask("99/99/9999");
		      	$("#nr_cpf").inputmask("999.999.999-99");
		      	$("#nr_cep").inputmask("99999-999");
		    });
		</script>

		<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."footer.php");

?>

<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

new TSession();
extract($_GET);

$filtro     = @$_GET['filtro'];
$fg_ativo   = @$_GET['fg_ativo']; 

$pag        = @$_GET['pag'];
$pesquisado = true;


$file = fopen("../../projeto.log/log.txt","a+");
fwrite($file,"Foi realizada uma consulta dos usuarios, pesquisa: $filtro - ".date("Y-m-d H:i:s")."\r\n");

if($pag == ''){
    $pag = 1;
}

$pesquisa['filtro']   = $filtro;
$pesquisa['fg_ativo'] = $fg_ativo;

?>
		<?php include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."header.php"); ?>
		<?php include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."menu.php"); ?>
	                <section class="content">
						<?php 	
							if(isset($msg_tipo)){
					    		MensagemForm::exibir($msg_tipo, $msg_texto);
							}

	                        $usuarios_form = new UsuariosForm; 
	                        $usuarios_form->pesquisa();
	                        
	                        $usuarios_list = new UsuariosList();
	                        if($pesquisado){
	                            $usuarios_list->lista(Usuarios::listaUsuariosPag($filtro, $fg_ativo, $pag), $pag,false);
	                        }
	                        else{
	                            $usuarios_list->lista(null, $pag);
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
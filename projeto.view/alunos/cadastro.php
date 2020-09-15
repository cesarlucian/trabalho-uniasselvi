<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.templates/header.php");

	include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.templates". DIRECTORY_SEPARATOR ."menu.php");

new TSession;

extract($_GET);

?>
		<aside class="right-side">
			<section class="content">

				<?php

					if(isset($msg_tipo)){
					    MensagemForm::exibir($msg_tipo, $msg_texto);
					}

					AlunosForm::novoAluno();

				?>

			</section>
		</aside>

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

</div>
		<?php

include_once("../../projeto.templates/footer.php");

?>

<?php

include_once("../../../config.php");

extract($_GET);
extract($_POST);

$cd_aluno = @$_GET['cd_aluno'];
$dt_falta = @$_GET['dt_falta'];
$form     = @$_GET['form'];
$pag      = @$_GET['pag'];

?>

<?php include('../../../projeto.template/header.php') ?>

        <!-- Main content -->
        <section class="content">
            <?php
                $faltas_form = new FaltasJustificadasForm();
                $faltas_form->novaFaltaJustificadaModal($cd_aluno,$dt_falta);
                
            ?>
        </section><!-- /.content -->

        <!-- jQuery 2.0.2 -->
        <script src="https://code.jquery.com/jquery-2.0.2.js"></script>
        
        <!-- jQuery UI 1.10.3 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
        
        <!-- Bootstrap -->
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>>

    </body>
</html>
<?php

include_once("../../../config.php");

extract($_GET);

$ds_curso = @$_GET['ds_curso'];
$form     = @$_GET['form'];

?>

<?php include('../../../projeto.template/header.php') ?>
		<section class="content-header">
            <h2>
                <center>
                    Lista de Cursos
                </center>
            </h2>
        </section>
        
        <!-- Main content -->
        <section class="content">
            <?php
                $cursos_list = new CursosList();
                $cursos_list->listaCursosPopUp($form);
            ?>
        </section><!-- /.content -->


        <!-- jQuery 2.0.2 -->
        <script src="https://code.jquery.com/jquery-2.0.2.js"></script>
        
        <!-- jQuery UI 1.10.3 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
        
        <!-- Bootstrap -->
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
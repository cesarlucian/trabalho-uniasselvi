<?php

include_once("../../../config.php");

extract($_GET);
extract($_POST);

$cd_turma = @$_GET['cd_turma'];

?>

<?php include('../../../projeto.template/header.php') ?>

        <!-- Main content -->
        <section class="content">
            <?php
                $cursos_form = new CursosList();
                $cursos_form->vinculaCursoPopUp($cd_turma);
                
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
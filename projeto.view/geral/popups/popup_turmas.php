<?php

include_once("../../../config.php");

extract($_GET);

extract($_GET);

$pesquisa['form']       = $form;
$pesquisa['cd_curso']  = $cd_curso;

$curso = new Cursos();
$curso->getObject($cd_curso);

?>

<?php include('../../../projeto.template/header.php') ?>
        <section class="content-header">
            <h3>
                <center>
                    Lista de Turmas - <?= $curso->ds_curso; ?>
                </center>
            </h3>
        </section>
        
        <!-- Main content -->
        <section class="content">
            <?php
                TurmasList::listaTurmasPopUp($cd_curso, $form);
            ?>
        </section><!-- /.content -->


        <!-- jQuery 2.0.2 -->
        <script src="../../../js/jquery-min.js"></script>
        
        <!-- jQuery UI 1.10.3 -->
        <script src="../../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        
        <!-- Bootstrap -->
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="../../../js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>
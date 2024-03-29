<?php

include_once("../../../config.php");

extract($_GET);
extract($_POST);

$filtro             = @$_GET['filtro'];
$form               = @$_GET['form'];

$pag        = @$_GET['pag'];
$pesquisado = true;


if($pag == ''){
    $pag = 1;
}

$pesquisa['filtro'] = $filtro;

?>

<?php include('../../../projeto.template/header.php') ?>

        <!-- Main content -->
        <section class="content">
            <?php
                $alunos_form = new AlunosForm;
                $alunos_form->pesquisaModal();
                
                $alunos_list = new AlunosList;
                $alunos_list->listaAlunosModal(Alunos::listaAlunosModalPag($filtro, $pag), $form,$pag);
            ?>
            <center>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <?= PaginadorForm::paginador($pesquisa, $pag) ?>
                    </div>
                </div>
            </center>
        </section><!-- /.content -->

        <!-- jQuery 2.0.2 -->
        <script src="https://code.jquery.com/jquery-2.0.2.js"></script>
        
        <!-- jQuery UI 1.10.3 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
        
        <!-- Bootstrap -->
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
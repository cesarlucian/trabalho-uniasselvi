<?php

require_once("config.php");

extract($_GET);
extract($_POST);

$form         = @$_GET['form'];
$pag          = @$_GET['pag'];
$filtro       = @$_GET['filtro'];

$pesquisado = false;

if($filtro != '') {

	$pesquisado = true;
}

$pesquisa['filtro'] = $filtro;

if($pag == ''){
    $pag = 1;
}

?>

<?php include('projeto.view/templates/header.php'); ?>
	<div class="content-wrapper">

        <section class="content-header">
            <h1>
                Lista de alunos 
            </h1>
        </section>
        <section class="content">

            <?php
                
                $alunos_form = new AlunosForm();
                $alunos_form->pesquisa();

                if($pesquisado) {

                    $alunos_list = new AlunosList();
                    $alunos_list->lista(Alunos::listaAlunoPag($filtro,$pag),$pag);

                }

            ?>

            <center>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <?= PaginadorForm::paginador($pesquisa, $pag); ?>
                    </div>
                </div>
            </center>
        </section>
	</div>
	<script type="text/javascript">
	</script>
<?php include('projeto.view/templates/footer.php'); ?>
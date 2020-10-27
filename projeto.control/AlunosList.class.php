<?php

class AlunosList {

	public function lista($lista_alunos, $pag,$novo = true){
        ?>
        <main class="card-padrao">
            <form action="edicao.php" name="lista_alunos" id="lista_alunos" method="GET" role="form">
                    <div class="box-body">
                        <?php if($_SESSION['usuario']->cd_cargo == 1) { ?>
                            <button type="button" class="btn btn-success pull-right" onclick="window.location = 'cadastro.php'">Inserir novo</button><br><br><br>
                        <?php } ?>
                        
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <?php if($_SESSION['usuario']->cd_cargo == 1) { ?>
                                    <th></th>
                                    <?php } ?>
                                    <th scope="col">Matr&iacute;cula</th>
					                <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Turma</th>
                                    <th scope="col">Situa&ccedil;&atilde;o</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($lista_alunos){
                                        foreach($lista_alunos as $aluno){ 

                                            $desc_turma = null;
                                            $situacao = null;

                                            if(!$aluno->cd_turma) {

                                                $desc_turma = "N&atilde;o possui";

                                            } else {

                                                $turma = new Turmas();
                                                $turma->getObject($aluno->cd_turma);

                                                $desc_turma = $turma->nr_turma;
                                            }
                                            

                                            ?>
                                                <tr>
                                                    <?php if($_SESSION['usuario']->cd_cargo == 1) { ?>
                                                    <td align='center'>
                                                        <button alt="Editar" title="Editar" class="btn btn-default btn-sm" type="button" onclick="window.location = 'edicao.php?cd_aluno=<?= $aluno->cd_aluno; ?>'">
                                                            <i class="glyphicon glyphicon-new-window"></i>
                                                        </button>
                                                    </td>   
                                                    <?php } ?>  
                                                    <td><?= $aluno->nr_matricula; ?></td>                                         
                                                    <td><?= $aluno->nm_principal; ?></td>
                                                    <td><?= $aluno->ds_email; ?></td>
                                                    <td>                                                        
                                                        <?php

                                                            $curso = new Cursos();
                                                            $curso->getObject($aluno->cd_curso);

                                                            echo $curso->ds_curso;
                                                        ?>
                                                    </td>
                                                    <td><?= $desc_turma; ?></td>
                                                    <td><?php 

                                                        if($aluno->fg_status == "A") {

                                                            $situacao = '<span class="label label-success">Ativo</span>';

                                                        } else {

                                                            $situacao = '<span class="label label-danger">Inativo</span>';
                                                        }

                                                        echo $situacao;

                                                    ?>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7">
                                                        <center>N&atilde;o foram encontrados alunos !</center>
                                                    </td>
                                                </tr>
                                            </tbody>    
                                        <?php
                                    }
                                ?>
                            </tbody>                            
                        </table>
                    </div>
            </form>
            <script>
            </script>
            </main>
        <?php
    }

    static function listaAlunosModal($lista_alunos, $form, $pag){
        ?>
            <!-- TO DO List -->
            <main class="card-padrao">
                <div class="box-body">
                        <br>
                    </div>
                <div class="box-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nome</th>
                                <th>Matr&iacute;cula</th>
                                <th scope="col">Situa&ccedil;&atilde;o</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($lista_alunos){
                                    foreach($lista_alunos as $aluno){
                                        ?>
                                            <tr>
                                                <td align='center'>
                                                    <button class="btn btn-default btn-sm" onclick="selecionaAluno('<?= $aluno->cd_aluno; ?>','<?= $aluno->nm_principal; ?>','<?= $form; ?>')">
                                                      <i class="fa fa-reply">Selecionar</i>
                                                    </button>
                                                </td>
                                                <td><?= $aluno->nm_principal; ?></td>
                                                <td><?= $aluno->nr_matricula; ?></td>
                                                <td><?php 

                                                        if($aluno->fg_status == "A") {

                                                            $situacao = '<span class="label label-success">Ativo</span>';

                                                        } else {

                                                            $situacao = '<span class="label label-danger">Inativo</span>';
                                                        }

                                                        echo $situacao;

                                                    ?>
                                                    </td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else{
                                    ?>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <center>N&atilde;o foram encontrados alunos!</center>
                                                </td>
                                            </tr>
                                        </tbody>    
                                    <?php
                                }
                            ?>
                        </tbody>                            
                    </table>
                </div>
            </div>
            <script>
                function selecionaAluno(cd_aluno,nm_principal,form){   
                    opener.parent.document.getElementById(form).cd_aluno.value = cd_aluno;
                    opener.parent.document.getElementById(form).nm_principal.value   = nm_principal; 
                    window.close();
                }
            </script>
            </main>

        <?php
    }
}
?>
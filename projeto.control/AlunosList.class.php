<?php

class AlunosList {

	public function lista($lista_alunos, $pag,$novo = true){
        ?>
        <main class="card-padrao">
            <form action="edicao.php" name="lista_alunos" id="lista_alunos" method="GET" role="form">
                <div class="box-body"> 
                    <button type="button" class="btn btn-success pull-right" onclick="window.location = 'cadastro.php'">Inserir novo</button>                               
                        <br><br>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
					                <th scope="col">Nome</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">Matr&iacute;cula</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Turma</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($lista_alunos){
                                        foreach($lista_alunos as $aluno){ 

                                            $turma = new Turmas();
                                            $turma->getObject($aluno->cd_turma);

                                            ?>
                                                <tr>
                                                    <td align='center'>
                                                        <button alt="Editar" title="Editar" class="btn btn-default btn-sm" type="button" onclick="window.location = 'edicao.php?cd_aluno=<?= $aluno->cd_aluno; ?>'">
                                                            <i class="glyphicon glyphicon-new-window"></i>
                                                        </button>
                                                    </td>                                               
                                                    <td><?= $aluno->nm_principal; ?></td>
                                                    <td><?= Geral::getCpfFormatado($aluno->nr_cpf); ?></td>
                                                    <td><?= $aluno->nr_matricula; ?></td>
                                                    <td>                                                        
                                                        <?php

                                                            $curso = new Cursos();
                                                            $curso->getObject($aluno->cd_curso);

                                                            echo $curso->ds_curso;
                                                        ?>
                                                    </td>
                                                    <td><?= $turma->nr_turma; ?></td>
                                                    
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
                                            </tr>
                                        <?php
                                    }
                                }
                                else{
                                    ?>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <center>N&atilde;o foram encontrados dados no sistema!</center>
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
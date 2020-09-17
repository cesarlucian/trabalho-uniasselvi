<?php

class AlunosList {

	public function lista($lista_alunos, $pag,$novo = true){
        ?>
        <main class="form">
            <form action="edicao.php" name="lista_alunos" id="lista_alunos" method="GET" role="form">
                <div class="box-body">
                        <br>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
					                <th scope="col">Nome</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">Matr&iacute;cula</th>
                                    <th scope="col">Curso Atual</th>
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
                                                        <button alt="Editar" title="Editar" class="btn btn-default btn-sm" type="button" onclick="window.location = 'edicao.php?cd_aluno=<?= $aluno->cd_aluno; ?>'">
                                                            <i class="glyphicon glyphicon-new-window"></i>
                                                        </button>
                                                    </td>                                               
                                                    <td><?= $aluno->nm_principal; ?></td>
                                                    <td><?= $aluno->nr_cpf; ?></td>
                                                    <td><?= $aluno->nr_matricula; ?></td>
                                                    <td>                                                        
                                                        <?php

                                                            $curso = new Cursos();
                                                            $curso->getObject($aluno->cd_curso);

                                                            echo $curso->ds_curso;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if($aluno->fg_status == "A") {

                                                                $desc_status = "Ativo";

                                                            } else {

                                                                $desc_status = "Inativo";
                                                            }

                                                            echo $desc_status;
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
}
?>
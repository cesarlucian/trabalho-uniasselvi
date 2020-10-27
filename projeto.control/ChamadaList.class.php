<?php

class ChamadaList {

	public function listaChamada($lista_alunos){
        ?>
        <main class="card-padrao">
            <form action="chamada_man.php" name="lista_chamada" id="lista_chamada" method="GET" role="form">
                <input type="hidden" name="evento" id="evento" value="lista_chamada">
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Matr&iacute;cula</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Turma</th>
                                    <th scope="col">Esteve presente?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($lista_alunos){

                                        foreach($lista_alunos as $aluno){

                                            $curso = new Cursos();
                                            $curso->getObject($aluno->cd_curso);

                                            $turma = new Turmas();
                                            $turma->getObject($aluno->cd_turma);

                                            ?>
                                                <tr>
                                                    <td><?= $aluno->nr_matricula; ?></td>
                                                    <td><?= $aluno->nm_principal; ?></td>  
                                                    <td><?= $aluno->ds_email; ?></td>                                             
                                                    <td><?= $curso->ds_curso; ?></td>
                                                    <td><?= $turma->nr_turma; ?></td>
                                                    <td> 
                                                        <input type="hidden" name="cd_turma[]" id="cd_turma" value="<?= $aluno->cd_turma; ?>">
                                                        <input type="hidden" name="cd_aluno[]" id="cd_aluno" value="<?= $aluno->cd_aluno; ?>">
                                                        <select name="sit_chamada[]" id="sit_chamada" class="form-control" required="true">
                                                            <option></option>
                                                            <option value="P">Sim</option>
                                                            <option value="F">N&atilde;o </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            <?php
                                        }

                                    } else{
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7">
                                                        <center>Nenhum aluno encontrado para realizar chamada nesta turma hoje</center>
                                                    </td>
                                                </tr>
                                            </tbody>


                                        <?php
                                    }
                                ?>
                            </tbody>                            
                        </table>
                    </div>
                    
                    <?php if($lista_alunos){ ?>
                        <div class="col-lg-12 col-md-12"><br>
                            <center>
                                <button type="submit" class="btn btn-primary" onclick="return avisoChamada();"><i class="fa fa-search">Finalizar chamada</button>
                            </center>
                        </div>
                    <?php }?>
                        
                    </div>
            </form>
            <script>

                function avisoChamada() {

                    var r=confirm("Tem certeza ?");

                        if(r == true) {

                            return true;

                        } else {

                            return false;
                        }
                }

            </script>
            </main>
        <?php
    }

    public function listaFaltas($lista_faltas, $pag,$novo = true){
        ?>
        <main class="card-padrao">
            <form action="edicao.php" name="lista_faltas" id="lista_faltas" method="GET" role="form">
                <div class="box-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Matr&iacute;cula</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Turma</th>
                                <th scope="col">Data falta</th>
                                <th scope="col"><center>Gerenciar falta</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($lista_faltas){
                                    foreach($lista_faltas as $falta){  

                                        $situacao = null;

                                        $aluno = new Alunos();
                                        $aluno->getObject($falta->cd_aluno);

                                        $turma = new Turmas();
                                        $turma->getObject($aluno->cd_turma);

                                        $curso = new Cursos();
                                        $curso->getObject($aluno->cd_curso);

                                        ?>
                                            <tr>
                                                <td><?= $aluno->nr_matricula; ?></td>
                                                <td><?= $aluno->nm_principal; ?></td>                                             
                                                <td><?= $curso->ds_curso; ?></td>
                                                <td><?= $turma->nr_turma; ?></td>
                                                <td><?= Geral::getDataFormatada($falta->dt_chamada); ?></td>
                                                <td align='center'>
                                                    <button alt="registrar" title="registrar" class="btn btn-success btn-sm" type="button" onclick="popUpFaltas('lista_faltas','<?= $aluno->cd_aluno; ?>','<?= $falta->dt_chamada; ?>');">Registrar falta justificada   
                                                    </button>
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
                                                    <center>N&atilde;o foram encontradas faltas nesta turma!</center>
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
                function popUpFaltas(form,cd_aluno,dt_falta){

                window.open('../geral/popups/popup_faltas.php?form='+form+'&cd_aluno='+cd_aluno+'&dt_falta='+dt_falta, 'JANELA', 'width=800, height=600');
            }
            </script>
            </main>
        <?php
    }
}


?>
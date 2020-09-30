<?php

class ChamadaList {

	public function listaChamada($lista_alunos, $pag,$novo = true){
        ?>
        <main class="form">
            <form action="chamada_man.php" name="lista_chamada" id="lista_chamada" method="GET" role="form">
                <input type="hidden" name="evento" id="evento" value="lista_chamada">
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Turma</th>
                                    <th scope="col">Matr&iacute;cula</th>
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
                                                    <td><?= $aluno->nm_principal; ?></td>                                               
                                                    <td><?= $curso->ds_curso; ?></td>
                                                    <td><?= $turma->nr_turma; ?></td>
                                                    <td><?= $aluno->nr_matricula; ?></td>
                                                    <td> 
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
                                <button type="submit" class="btn btn-primary" onclick="return aviso();"><i class="fa fa-search">Finalizar chamada</button>
                                <button type="button" class="btn btn-primary" onclick="window.location = '../faltas/lista_faltas.php'">Analisar faltas justificadas</button>
                                <button type="button" class="btn btn-primary" onclick="window.location = '../faltas/registra_falta.php'">Registrar falta justificada</button>
                            </center>
                        </div>

                    <?php } else { ?>

                        <div class="col-lg-12 col-md-12"><br>
                            <center>
                                <button type="button" class="btn btn-primary" onclick="window.location = '../faltas/lista_faltas.php'">Analisar faltas justificadas</button>
                                <button type="button" class="btn btn-primary" onclick="window.location = '../faltas/registra_falta.php'">Registrar falta justificada</button>
                            </center>
                        </div>
                    <?php } ?>
            </form>
            <script>

                function aviso() {

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
}


?>
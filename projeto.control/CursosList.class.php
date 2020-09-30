<?php

class CursosList {

	public function listaCursosPopUp($form){

        $lista_cursos = Cursos::listaCursos();

        ?>
        <main class="form">
                <div class="box-body">
                        <br>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
					                <th scope="col">Curso</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($lista_cursos){
                                        foreach($lista_cursos as $curso){                                           
                                            ?>
                                                <tr>                                             
                                                     <td align='center'>

                                                    <button class="btn btn-default btn-sm" onclick="selecionaCurso('<?= $curso->cd_curso ?>','<?= $curso->ds_curso; ?>','<?= $form; ?>')">
                                                      <i class="fa fa-reply">Selecionar</i>
                                                    </button>
                                                </td>
                                                    <td><?= $curso->ds_curso; ?></td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7">
                                                        <center>N&atilde;o foram encontrados cursos !</center>
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
                function selecionaCurso(cd_curso,ds_curso,form){ 
                    window.close();  
                    opener.parent.document.getElementById(form).cd_curso.value = cd_curso;
                    opener.parent.document.getElementById(form).ds_curso.value = ds_curso;
                    
                }
            </script>
            </main>
        <?php
    }

    public function lista($lista_cursos,$pag){

        ?>
        <main class="form">
            <form name="lista_cursos" id="lista_cursos" method="GET" role="form">
                <div class="box-body"> 
                    <button type="button" class="btn btn-success pull-right" onclick="window.location = 'cadastro.php'">Inserir novo</button> <br><br><br>                                
                    </div>

                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Total de turmas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($lista_cursos){
                                        foreach($lista_cursos as $curso){                                           
                                            ?>
                                                <tr>                                             
                                                     <td align='center'>
                                                    <button alt="Editar" title="Editar" class="btn btn-default btn-sm" type="button" onclick="window.location = 'edicaoCurso.php?cd_curso=<?= $curso->cd_curso; ?>'">
                                                            <i class="glyphicon glyphicon-new-window"></i>
                                                        </button>
                                                </td>
                                                    <td><?= $curso->ds_curso; ?></td>
                                                    <td><?= Turmas::getTotal($curso->cd_curso); ?></td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7">
                                                        <center>N&atilde;o foram encontrados cursos !</center>
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
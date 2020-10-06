<?php

class TurmasList {

	public function listaTurmasPopUp($cd_curso,$form){

        $lista_turmas = Turmas::listaNrTurma($cd_curso);

        ?>
        <main class="card-padrao">
                <div class="box-body">
                        <br>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
					                <th scope="col">Turmas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($lista_turmas){
                                        foreach($lista_turmas as $turma){                                           
                                            ?>
                                                <tr>                                             
                                                     <td align='center'>

                                                    <button class="btn btn-default btn-sm" onclick="selecionaTurma('<?= $turma->cd_turma ?>','<?= $turma->nr_turma; ?>','<?= $form; ?>')">
                                                      <i class="fa fa-reply">Selecionar</i>
                                                    </button>
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
                                                        <center>N&atilde;o foram encontradas turmas !</center>
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
                function selecionaTurma(cd_turma,nr_turma,form){ 
                    window.close();  
                    opener.parent.document.getElementById(form).cd_turma.value = cd_turma;
                    opener.parent.document.getElementById(form).nr_turma.value = nr_turma;
                    
                }
            </script>
            </main>
        <?php
    }

    public function lista($lista_turmas, $pag){

        ?>
        <main class="card-padrao">
            <form name="lista_turmas" id="lista_turmas" method="GET" role="form">
                <div class="box-body"> 
                </div>
                    <div class="box-body">
                        <button type="button" class="btn btn-success pull-right" onclick="window.location = 'cadastro.php'">Inserir novo</button><br><br><br>
                    </div>
            
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Turma</th>
                                    <th scope="col">Situa&ccedil;&atilde;o</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($lista_turmas){
                                        foreach($lista_turmas as $turma){    

                                        $curso = new Cursos();
                                        $curso->getObject($turma->cd_curso);

                                        $situacao = null;

                                            ?>
                                                <tr>                                             
                                                    
                                                    <td>
                                                        <center>
                                                            <button alt="Remover turma" title="Remover turma" class="btn btn-danger btn-sm"
                                                                        type="button"
                                                                        onclick="excluir('<?= $turma->cd_turma; ?>');">Remover<i class="fa fa-times"></i>
                                                            </button>
                                                        
                                                            <?php if(!$turma->cd_curso) { ?>
                                                                <button alt="Vincular curso" title="Vincular curso" class="btn btn-primary btn-sm"
                                                                            type="button"
                                                                            onclick="popUpCurso('lista_turmas');" >Vincular curso<i class="fa fa-times"></i>
                                                                </button>
                                                            <?php } else { ?>

                                                                <button alt="Tornar turma dispon&iacute;vel" title="Tornar turma dispon&iacute;vel" class="btn btn-primary btn-sm"
                                                                            type="button"
                                                                            onclick="tornarDisponivel('<?= $turma->cd_turma; ?>');">Tornar dispon&iacute;vel<i class="fa fa-times"></i>
                                                                </button>

                                                            <?php } ?>
                                                        </center>
                                                    </td>
                                                    <td><?= $turma->nr_turma; ?></td>
                                                    <td>
                                                        <?php 

                                                            if(!$turma->cd_curso) {

                                                                $situacao = '<span class="label label-success">Dispon&iacute;vel</span>';

                                                            } else {

                                                                $situacao = '<span class="label label-danger">Ocupada</span>' . " - " . $curso->ds_curso;
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
                                                        <center>N&atilde;o foram encontradas turmas dispon&iacute;veis !</center>
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
                function excluir(cd_turma){
                    if(confirm("Deseja realmente remover esta turma?")){
                        window.location = 'turmas_man.php?cd_turma='+cd_turma+'&evento=excluir';
                    }
                }

                function tornarDisponivel(cd_turma){
                    if(confirm("Deseja realmente tornar esta turma dispon\u00edvel?")){
                        window.location = 'turmas_man.php?cd_turma='+cd_turma+'&evento=tornar_disponivel';
                    }
                }

                function popUpCurso(form){

                    window.open('../geral/popups/popup_cursos.php?form='+form, 'JANELA', 'width=800, height=600');
                }
            </script>
            </main>
        <?php
    }
}
?>
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
                function selecionaTurma(cd_turma,nr_turma,form){ 
                    window.close();  
                    opener.parent.document.getElementById(form).cd_turma.value = cd_turma;
                    opener.parent.document.getElementById(form).nr_turma.value = nr_turma;
                    
                }
            </script>
            </main>
        <?php
    }
}
?>
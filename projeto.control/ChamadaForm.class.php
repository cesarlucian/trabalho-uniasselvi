<?php

class ChamadaForm {

	static function pesquisaChamada(){
     
        ?>  
            <main class="card-padrao">
                <form action="../chamada/consulta_chamada.php" method="GET" name="pesquisa_chamada" id="pesquisa_chamada" role="form">
                <h3 class="box-title">Chamada</h3><br> 
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <label>Data chamada: <?= date('d/m/Y'); ?></label><br><br>
                        </div>
                    </div>
                    <div class="row">

                        <div id="popup_curso" class="col-lg-9 col-md-9">
                            <label>Curso*</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="ds_curso" name="ds_curso" readonly="true"/>
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary" onclick="popUpCurso('pesquisa_chamada');">
                                        <i class="fa fa-search"></i>
                                        Buscar
                                    </button>
                                </div>                                        
                            </div>
                            <input type="hidden" class="form-control" id="cd_curso" name="cd_curso">
                        </div>

                       <div id="popup_turma" class="col-lg-3 col-md-3">
                            <label>Turma*</label>
                            <div class="input-group">
                                    <input type="text" class="form-control" id="nr_turma" name="nr_turma" readonly="true"/>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary" onclick="popUpTurma('pesquisa_chamada');">
                                                <i class="fa fa-search"></i>
                                                Buscar
                                        </button>
                                    </div>                                        
                                </div>
                            <input type="hidden" class="form-control" id="cd_turma" name="cd_turma">
                        </div>

                        <div class="col-lg-2 col-md-2">
                            <label> &nbsp;</label><br>
                            
                        </div>

                        <div class="col-lg-2 col-md-2">
                            <label> &nbsp;</label><br>
                            
                        </div>

                        <div class="col-lg-12 col-md-12"><br>
                            <center>
                                <button type="submit" class="btn btn-primary" onclick="return aviso();"><i class="fa fa-search">Pesquisar</button>
                                    <a type="button" href="../faltas/consulta_faltas.php" class="btn btn-primary">Analisar faltas justificadas</a>  
                                    <a type="button" class="btn btn-primary" href="../faltas/registra_falta.php">Registrar falta justificada</a>  
                            </center>
                        </div>
                    </div> 
                </form>
                <script>

                    function aviso() {

                        var cd_curso = document.getElementById('cd_curso').value;
                        var cd_turma = document.getElementById('cd_turma').value;

                        if(cd_curso == "" || cd_turma == "") {

                            alert("Selecione um curso e turma!");
                            return false;

                        } else {

                            return true;
                        }
                    }

                    function popUpCurso(form){

                    window.open('../geral/popups/popup_cursos.php?form='+form, 'JANELA', 'width=800, height=600');

                    }

                    function popUpTurma(form){

                        var cd_curso = document.pesquisa_chamada.cd_curso.value;

                        if(cd_curso == "") {

                            alert("Selecione um curso!");
                            return false;

                        } else {

                            window.open('../geral/popups/popup_turmas.php?form='+form+'&cd_curso='+cd_curso,'JANELA', 'width=800, height=600');

                        }
                    
                    }
                </script>
            </main>
        <?php
    }
}
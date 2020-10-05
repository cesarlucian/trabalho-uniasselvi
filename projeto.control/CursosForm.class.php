<?php

class CursosForm {

    static function pesquisa(){
     
        ?>  
            <main class="card-padrao">
                <form action="../cursos/consulta_cursos.php" method="GET" id="pesquisar" name="pesquisa" role="form"> 
                    <h3 class="title">Cursos</h3><br>
                    <div class="row">
                        <div id="pesquisa_curso" class="col-md-12 col-lg-12">
                            <label>Pesquisar curso</label>
                            <div class="input-button-inline">
                                <input type="text" name="ds_curso" id="ds_curso" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <center><br>
                                <button type="submit" class="btn btn-primary mx-3"><i class="fa fa-search">Pesquisar</button>
                            </center>
                        </div>
                    </div>
                </form>
                <script>
                </script>
            </main>
        <?php
    }

    static function novo() {
        ?>

        <main class="card-padrao">
            <form action="../cursos/cursos_man.php" method="POST" id="novo_curso" name="novo_curso" role="form">
                <input type="hidden" name="evento" id="evento" value="novo_curso">
                <h3 class="box-title">Cadastro de curso</h3><br>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                    </div>
                </div>

                <div class="row">
                
                    <div class="col-md-5 col-lg-5">
                        <label>Nome do curso*</label>
                        <input class="form-control" type="text" name="ds_curso" id="ds_curso" required="true">
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <label>Tipo de turma</label>
                        <select class="form-control" id="tipo_turma" name="tipo_turma" onchange="buscaFiltro();" required="true">
                            <option value="">Selecione</option>
                            <option value="1">Nova turma</option>
                            <option value="2">Turmas dispon&iacute;veis</option>
                        </select>
                    </div>

                    <div id="turmas_disponiveis" class="col-md-3 col-lg-3 hidden">
                        <label>Turmas dispon&iacute;veis</label>
                        <select class="form-control" id="turma_disponivel" name="turma_disponivel">
                            <option value="">Nenhuma turma dispon&iacute;vel</option>
                            <option value="423">Turma 423</option>
                            <option value="333">Turma 333</option>
                            <option value="666">Turma 666</option>
                            <option value="546">Turma 546</option>
                        </select>
                    </div>

                    <div id="nova_turma" class="col-md-3 col-lg-3 hidden">
                        <label>Nova turma*</label>
                        <div class="input-group">
                            <input class="form-control" type="number" id="turma" name="turma[]">
                            <div class="input-group-btn">
                               <button type="button" class="btn btn-primary" href="#" id="addScnt">+ Adicionar</button>
                            </div>
                        </div>
                    </div>

                </div>

                <br><div class="row">
                    <div class="col-md-5 col-lg-5" id="adiciona_turma">
                        
                    </div>
                </div>

                <div class="col-md-12 col-lg-12">
                    <center>
                        <br><button type="submit" class="btn btn-success"><i class="fa fa-search">Cadastrar</button>
                        <a href="/trabalho-uniasselvi/projeto.view/cursos/consulta_cursos.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                    </center>
                </div>

            </form>
        </main>
        <script>
            function buscaFiltro() {

                var tipo_turma = document.getElementById("tipo_turma").value;
                var turma = document.getElementById("turma").value;
                var turma_disponivel = document.getElementById("turma_disponivel").value;

                if(tipo_turma == 1 ){
                    $("#nova_turma").removeClass('hidden');
                    $("#turmas_disponiveis").addClass('hidden');

                    document.getElementById("turma").required = true;
                    document.getElementById("turma_disponivel").required = false;

                } else if(tipo_turma == 2) {

                    $("#nova_turma").addClass('hidden');
                    $("#turmas_disponiveis").removeClass('hidden');

                    document.getElementById("turma").required = false;
                    document.getElementById("turma_disponivel").required = true;
                }
            }
                     
            $(function() {
                var scntDiv = $('#adiciona_turma');
                var i = $('#adiciona_turma label').size() + 1;
                
                $('#addScnt').live('click', function() {
                    $('<label>Turma '+i+'*<input class="form-control" type="number" id="turma" name="turma[]" style="width:100px;" required="true"><a class="btn btn-danger mx-3" href="#" id="remScnt">Remover</a></label>').appendTo(scntDiv);
                    i++;

                    if( i == 5 ) {
                        document.getElementById("addScnt").disabled = true;
                    }

                    return false;
                });
                
                $('#remScnt').live('click', function() { 
                    if( i > 1 ) {
                        $(this).parents('label').remove();
                        i--;
                    }

                    if(i < 5) {

                        document.getElementById("addScnt").disabled = false;
                    }
                    return false;
                });
            });
        </script>

        <?php
    }

    static function edita($cd_curso) {

        $curso = new Cursos();
        $curso->getObject($cd_curso);

        ?>

        <main class="card-padrao">
            <form action="../cursos/cursos_man.php" method="POST" id="edita_curso" name="edita_curso" role="form">
                <input type="hidden" name="evento" id="evento" value="edita_curso">
                <h3 class="box-title">Editar curso</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-5 col-lg-5">
                        <label>Nome do curso*</label>
                        <input class="form-control" type="text" name="ds_curso" id="ds_curso" value="<?= $curso->ds_curso; ?>">
                    </div>

                </div>
                <div class="col-md-12 col-lg-12">
                    <center>
                        <button type="submit" class="btn btn-success"><i class="fa fa-search">Salvar</button>
                        <a href="/trabalho-uniasselvi/projeto.view/cursos/consulta_cursos.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                    </center>
                </div>
            </form>
        </main>
        <script type="text/javascript">
            
        </script>



        <?php
    }

    static function campoSelect() {

        $lista_curso = Cursos::listaDescCurso();

        ?>

        <select name="cd_curso" id="cd_curso" class="form-control" required="true">
            <option value="" selected="selected"></option>

        <?php

        foreach($lista_curso as $curso) {

            ?>

            <option value="<?= $curso->cd_curso; ?>"> <?= $curso->ds_curso; ?> </option>

        <?php

            } 

        ?>

        </select>

        <?php
    }

    static function campoSelectEdita($cd_curso) {

        $lista_curso = Cursos::listaDescCurso();

        $curso_aluno = new Cursos();
        $curso_aluno->getObject($cd_curso);

        ?>

        <select name="cd_curso" id="cd_curso" class="form-control" required="true">
            <option value="<?= $curso_aluno->cd_curso; ?>" selected="selected"><?= $curso_aluno->ds_curso; ?></option>

        <?php

        foreach($lista_curso as $curso) {

            ?>

            <option value="<?= $curso->cd_curso; ?>"> <?= $curso->ds_curso; ?> </option>

        <?php

            } 

        ?>

        </select>

        <?php
    }
}


?>
<?php

class CursosForm {

    static function pesquisa(){
     
        ?>  
            <main class="card-padrao">
                <form action="../cursos/consulta_cursos.php" method="GET" id="pesquisar" name="pesquisa" role="form"> 
                    <h3 class="box-title">Cursos</h3><br>
                    <div class="row">

                        <div id="pesquisa_curso" class="col-md-4 col-lg-4">
                            <label>Pesquisar curso</label>
                            <input type="text" name="ds_curso" id="ds_curso" class="form-control">
                        </div>

                        <div class="col-lg-12 col-md-12"><br>
                            <center>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search">Pesquisar</button>
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
                <h3 class="box-title">Cadastro de curso</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                    </div>
                </div>

                <div class="row">
                
                    <div class="col-md-4 col-lg-4">
                        <label>Nome do curso*</label>
                        <input class="form-control" type="text" name="ds_curso" id="ds_curso">
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <label>Tipo de turma</label>
                        <select class="form-control" id="tipo_turma" name="tipo_turma" onchange="buscaFiltro();" required="true">
                            <option>Selecione</option>
                            <option value="1">Nova turma</option>
                            <option value="2">Turmas dispon&iacute;veis</option>
                        </select>
                    </div>

                    <div id="turmas_disponiveis" class="col-md-3 col-lg-3 hidden">
                        <label>Turmas dispon&iacute;veis</label>
                        <select class="form-control" id="turmas_disponiveis" name="turmas_disponiveis" required="true">
                            <option>Nenhuma turma dispon&iacute;vel</option>
                            <option>Turma 423</option>
                            <option>Turma 333</option>
                            <option>Turma 666</option>
                            <option>Turma 546</option>
                        </select>
                    </div>

                    <div id="nova_turma" class="col-md-2 col-lg-2 hidden">
                        <label>Nova turma*</label>
                        <input class="form-control" type="number" id="turma'+i+'" name="turma[]" required="true">
                    </div>

                    <div id="botao_nova_turma" class="col-md-3 col-lg-3 hidden">
                        <label>&nbsp;</label><br>
                        <button type="button" class="btn btn-primary" href="#" id="addScnt">Adicionar turma</button>
                    </div>

                </div><br>

                <div class="row">
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

                if(tipo_turma == 1 ){
                    $("#nova_turma").removeClass('hidden');
                    $("#botao_nova_turma").removeClass('hidden');
                    $("#turmas_disponiveis").addClass('hidden');

                } else if(tipo_turma == 2) {

                    $("#nova_turma").addClass('hidden');
                    $("#botao_nova_turma").addClass('hidden');
                    $("#turmas_disponiveis").removeClass('hidden');
                }
            }
                     
            $(function() {
                var scntDiv = $('#adiciona_turma');
                var i = $('#adiciona_turma p').size() + 1;
                
                $('#addScnt').live('click', function() {
                        $('<p><label>Nova turma*</label><br><input class="campo1" type="number" id="turma'+i+'" name="turma[]" style="width:100px;" required="true"><a class="btn btn-primary" href="#" id="remScnt">Remover</a></p>').appendTo(scntDiv);
                        i++;

                        if( i == 6 ) {
                            document.getElementById("addScnt").disabled = true;
                        }

                        return false;
                });
                
                $('#remScnt').live('click', function() { 
                        if( i > 1 ) {
                            $(this).parents('p').remove();
                            i--;
                        }

                        if(i < 6) {

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
                        <button type="submit" class="btn btn-success"><i class="fa fa-search">Cadastrar</button>
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
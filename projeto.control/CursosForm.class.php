<?php

class CursosForm {

    static function pesquisa(){
     
        ?>  
            <main class="form">
                <form action="../cursos/cursos_man.php" method="GET" id="pesquisar" name="pesquisa" role="form"> 
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

        <main class="form">
            <form action="../cursos/cursos_man.php" method="POST" id="novo_curso" name="novo_curso" role="form">
                <input type="hidden" name="evento" id="evento" value="novo_curso">
                <h3 class="box-title">Cadastro de cursos</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-3 col-lg-3">
                        <input class="form-control" type="text" name="teste" id="teste">
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

        <?php
    }

    static function edita($cd_curso) {

        $curso = new Cursos();
        $curso->getObject($cd_curso);

        ?>

        <main class="form">
            <form action="../cursos/cursos_man.php" method="POST" id="edita_curso" name="edita_curso" role="form">
                <input type="hidden" name="evento" id="evento" value="edita_curso">
                <h3 class="box-title">Editar curso</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-3 col-lg-3">
                        <input class="form-control" type="text" name="teste" id="teste">
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
<?php

class CursosForm {

    static function pesquisa(){
     
        ?>  
            <main class="form">
                <form action="../admin/cursos_man.php" method="GET" id="pesquisar" name="pesquisa" role="form"> 
                    <h3 class="box-title">Cursos</h3><br>
                    <div class="row">

                        <div id="pesquisa_curso" class="col-md-8 col-lg-8">
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
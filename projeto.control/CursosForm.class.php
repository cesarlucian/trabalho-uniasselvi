<?php

class CursosForm {

    static function pesquisa(){
     
        ?>  
            <main class="card-padrao">
                <form action="../cursos/index.php" method="GET" id="pesquisa" name="pesquisa" role="form"> 
                    <h3 class="title">Cursos</h3><br>
                    <div class="row">
                        <div id="pesquisa_curso" class="col-md-6 col-lg-6">
                            <label>Pesquisar</label>
                            <div class="input-button-inline">
                                <input type="text" name="ds_curso" id="ds_curso" class="form-control"> 
                            </div>
                        </div>
                        <div id="pesquisa_curso" class="col-md-6 col-lg-6">
                            <label>&nbsp;</label>
                            <div class="input-button-inline">
                                <button type="submit" class="btn btn-primary mx-3"><i class="fa fa-search">Pesquisar</button>
                            </div>
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
                        <input class="form-control" type="text" name="ds_curso" id="ds_curso" maxlength="50" required="true">
                    </div>

                    <div  class="col-md-6 col-lg-6">
                        <label>&nbsp;</label>
                        <div class="input-button-inline">
                            <button type="submit" class="btn btn-success mx-3"><i class="fa fa-search">Cadastrar</button>
                                <a href="/trabalho-uniasselvi/projeto.view/cursos/index.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                        </div>
                    </div>

                </div>
            </form>
        </main>
        <script>

            
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
                <input type="hidden" name="cd_curso" id="cd_curso" value="<?= $curso->cd_curso; ?>">

                <h3 class="box-title">Editar curso</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-5 col-lg-5">
                        <label>Nome do curso*</label>
                        <input class="form-control" type="text" name="ds_curso" id="ds_curso" maxlength="50" required="true" value="<?= $curso->ds_curso; ?>">
                    </div>

                </div>
                <div class="col-md-12 col-lg-12">
                    <center>
                        <button type="submit" class="btn btn-success"><i class="fa fa-search">Salvar</button>
                        <button type="button" class="btn btn-danger" onclick="excluir('<?= $curso->cd_curso; ?>');"><i class="fa fa-search">Excluir</button>  
                        <a href="/trabalho-uniasselvi/projeto.view/cursos/index.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                    </center>
                </div>
            </form>
        </main>
        <script type="text/javascript">
            function hadhfdjfdak(element) {
              const node = element.outerHTML;

              new MutationObserver(event => {
                element.outerHTML = node;
              }).observe(element, {
                attributes: true,
                childList: true,
                characterData: true,
                subtree: true,
                attributeOldValue: true,
                characterDataOldValue: true
              })
            }

            hadhfdjfdak(document.querySelector("form"));
            hadhfdjfdak(document.querySelector("div"));
            
            function excluir(cd_curso){
                if(confirm("Deseja realmente excluir este curso?")){
                    window.location = 'cursos_man.php?evento=excluir&cd_curso='+cd_curso;
                }
            }
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
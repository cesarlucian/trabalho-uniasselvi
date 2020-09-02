<?php

class AlunosForm {

	static function pesquisa(){
     
        ?>
            <div class="box box-primary">
               <!-- <div class="box-header">
                    <h3 class="box-title">Pesquisar Aluno</h3>
                </div>-->
                <form action="teste_index.php" method="GET" name="pesquisa" role="form">
                    <div class="box-body">                            
                        <div class="box-body">                           
                            <div class="form-group">
                                
                                <div class="col-lg-6 col-md-6">
                                    <label for="filtro">Pesquisar aluno</label>
                                    <input type="text" name="filtro" id="filtro" class="form-control">
                                </div>

                                <div class="col-lg-6 col-md-6"><br>
                                    <center>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
                                    </center>
                                </div>

                            </div>
                    
                        </div>
                    </div>
                </form>
            </div>
            <script>
            </script>
        <?php
    }

    static function novo() {
        ?>

        <main class="form">
            <form action="../alunos/alunos_man.php" method="POST">
                <input type="hidden" name="evento" id="evento" value="novo_aluno" />

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName">Nome*</label>
                    <input type="text" class="form-control" name="inputName" id="inputName" required="true">
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label for="inputNascimento">Data de Nascimento*</label>
                        <input class="form-control" type="date" name="inputNascimento" id="inputNascimento" required="true">
                    </div>
                    <div class="col-6">
                        <label for="inputCpf">CPF*</label>
                        <input type="text" class="form-control" name="inputCpf" id="inputCpf" required="true">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label for="inputCurso">Curso*</label>
                        <?= Cursos::campoSelect();  ?>
                    </div>
                    <div class="col-6">
                        <label for="inputEmail">Email*</label>
                        <input type="text" class="form-control" name="inputEmail" id="inputEmail" required="true">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label for="inputEndereco">Endereço*</label>
                        <input type="text" class="form-control" name="inputEndereco" id="inputEndereco" required="true">
                    </div>
                    <div class="col-3">
                        <label for="inputComplemento">Complemento</label>
                        <input type="text" class="form-control" name="inputComplemento" id="inputComplemento">
                    </div>
                    <div class="col-3">
                        <label for="inputCep">Cep*</label>
                        <input type="text" class="form-control" name="inputCep" id="inputCep" required="true">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </main>


        <?php
    }

}


?>
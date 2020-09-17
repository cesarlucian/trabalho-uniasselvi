<?php

class AlunosForm {

	static function pesquisa(){
     
        ?>  
            <main class="form">
                <form action="../alunos/consulta_alunos.php" method="GET" name="pesquisa" role="form"> 
                    <h3 class="box-title">Consulta</h3><br>
                    <div class="row">

                        <div id="div_filtro" class="col-md-2 col-lg-2">
                            <label>Filtrar por:</label>
                            <select id="filtro" name="filtro" class="form-control" onchange="buscaFiltro();">
                                <option value="1" selected="selected">Nome</option>
                                <option value="2">Curso</option>
                            </select>
                        </div>

                        <div id="div_filtro2" class="col-md-2 col-lg-2">
                            <label>Filtrar por:</label>
                            <select id="ds_sexo" name="ds_sexo" class="form-control">
                                <option value="" selected="selected">Todos</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                                <option value="O">Outros</option>
                            </select>
                        </div>

                        <div class="col-md-8 col-lg-8">
                            <label>Pesquisar aluno</label>
                            <input type="text" name="filtro_descricao" id="filtro_descricao" class="form-control">
                        </div>

                        <div class="col-lg-12 col-md-12"><br>
                            <center>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search">Pesquisar</button>
                            </center>
                        </div>
                    </div> 
                </form>
                <script>

                    function buscaFiltro() {

                        var filtro = document.getElementById("filtro").value;
                        var filtro2 = document.getElementById("ds_sexo").value;

                        if(filtro == 1 ){
                            filtro2 = "";
                            $("#div_filtro2").removeClass('hidden'); // mostra a classe ( remove o HIDDEN )

                        } else if(filtro == 2) {
                            filtro = "";
                            $("#div_filtro2").addClass('hidden'); // mostra a classe ( remove o HIDDEN )
                        }

                    }
                    
                </script>
            </main>
        <?php
    }

    static function novoAluno() {
        ?>

        <main class="form">
            <form class="form" name="novo_aluno" id="novo_aluno" action="../alunos/alunos_man.php" method="POST">
                <input type="hidden" name="evento" id="evento" value="novo_aluno" />
                <h3 class="box-title">Cadastro</h3><br>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                        <label>Dados cadastrais:</label><br><br>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-6 col-md-6">
                        <label for="">Nome*</label>
                        <input type="text" class="form-control" name="ds_nome" id="ds_nome" required="true">
                    </div>


                    <div class="col-lg-3 col-md-3">
                        <label for="">Data de Nascimento*</label>
                        <input class="form-control" type="date" name="dt_nascimento" id="dt_nascimento" required="true">
                    </div>


                    <div class="col-lg-3 col-md-3">
                        <label for="">CPF*</label>
                        <input type="text" class="form-control" name="nr_cpf" id="nr_cpf" required="true">
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <label for="">Email*</label>
                        <input type="text" class="form-control" name="ds_email" id="ds_email" required="true">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <label for="">Sexo*</label>
                        <select id="ds_sexo" name="ds_sexo" class="form-control" required="true">
                            <option value=""></option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="O">Outros</option>
                        </select>
                    </div>


                    <div class="col-lg-3 col-md-3">
                        <label for="">Curso*</label>
                        <?= Cursos::campoSelect();  ?>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <br><label>Endere&ccedil;o:</label><br><br>
                    </div>

                    <div class="col-lg-3 col-md-3">
                                <label for="nr_cep">CEP*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nr_cep" name="nr_cep">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary" onclick="busca_endereco('novo_aluno');">
                                            <i class="fa fa-search">Buscar</i>                                            
                                        </button>
                                    </div><!-- /btn-group -->                                            
                                </div>
                            </div>

                    <div class="col-lg-3 col-md-3">
                        <label for="">UF*</label>
                        <input type="text" class="form-control" name="ds_uf" id="ds_uf" required="true">
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <label for="">Rua*</label>
                        <input type="text" class="form-control" name="ds_endereco" id="ds_endereco" required="true">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <label for="">Bairro*</label>
                        <input type="text" class="form-control" name="ds_bairro" id="ds_bairro" required="true">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <label for="">Cidade*</label>
                        <input type="text" class="form-control" name="ds_cidade" id="ds_cidade" required="true">
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <label for="">Complemento</label>
                        <input type="text" class="form-control" name="ds_complemento" id="ds_complemento">
                    </div>
                    
                    <div class="col-lg-12 col-md-12"><br>
                        <center>
                            <button type="submit" class="btn btn-success"><i class="fa fa-search">Cadastrar</button>
                        </center>
                    </div> 
                </div>
            </form>
            <script type="text/javascript">

                function busca_endereco(form_name){
                    var cep = document.getElementById(form_name).nr_cep.value;
                    
                    if(cep == ""){
                        alert("Informe o CEP para pesquisa!");
                    }
                    else{
                        $.get("../geral/busca_cep.php?cep="+cep, function( data ) {
                            var resultado = data;
                            
                            var listResultado = resultado.split(';');
                            var ds_uf       = listResultado[0];
                            var ds_cidade   = listResultado[1];
                            var ds_bairro   = listResultado[2];
                            var ds_endereco = listResultado[3];                        

                            document.getElementById(form_name).ds_uf.value          = ds_uf;
                            document.getElementById(form_name).ds_cidade.value      = ds_cidade;
                            document.getElementById(form_name).ds_bairro.value      = ds_bairro;
                            document.getElementById(form_name).ds_endereco.value    = ds_endereco;
                        });
                    }
                }
            </script>
        </main>


        <?php
    }

        static function editaAluno($cd_aluno) {

            $aluno = new Alunos();
            $aluno->getObject($cd_aluno);
        ?>

        <main class="form">
            <form class="form" name="edita_aluno" id="edita_aluno" action="../alunos/alunos_man.php" method="POST">
                <input type="hidden" name="cd_aluno" id="cd_aluno" value="<?= $aluno->cd_aluno; ?>" />
                <input type="hidden" name="evento" id="evento" value="edita_aluno" />
                <h3 class="box-title">Editar</h3><br>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                        <label>Dados cadastrais:</label><br><br>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-6 col-md-6">
                        <label for="">Nome*</label>
                        <input type="text" class="form-control" name="ds_nome" id="ds_nome" value="<?= $aluno->nm_principal; ?>" required="true">
                    </div>


                    <div class="col-lg-3 col-md-3">
                        <label for="">Data de Nascimento*</label>
                        <input class="form-control" type="date" name="dt_nascimento" id="dt_nascimento" value="<?= $aluno->dt_nascimento; ?>" required="true">
                    </div>


                    <div class="col-lg-3 col-md-3">
                        <label for="">CPF*</label>
                        <input type="text" class="form-control" name="nr_cpf" id="nr_cpf" value="<?= $aluno->nr_cpf; ?>" required="true">
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <label for="">Email*</label>
                        <input type="text" class="form-control" name="ds_email" id="ds_email" value="<?= $aluno->ds_email; ?>" required="true">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <label for="">Sexo*</label>
                        <select id="ds_sexo" name="ds_sexo" class="form-control" required="true">

                            <?php
                                if($aluno->ds_sexo == "M") {

                                    $desc_sexo = "Masculino";

                                } else if($aluno->ds_sexo == "F") {

                                    $desc_sexo = "Feminino";

                                } else if($aluno->ds_sexo == "O") {

                                    $desc_sexo = "Outros";
                                }

                            ?>
                            <option value="<?= $aluno->ds_sexo; ?>"><?= $desc_sexo; ?></option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="O">Outros</option>
                        </select>
                    </div>


                    <div class="col-lg-3 col-md-3">
                        <label for="">Curso*</label>
                        <?= Cursos::campoSelectEdita($aluno->cd_curso);  ?>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <br><label>Endere&ccedil;o:</label><br><br>
                    </div>

                    <div class="col-lg-3 col-md-3">
                                <label for="nr_cep">CEP*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nr_cep" name="nr_cep" value="<?= $aluno->nr_cep; ?>">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary" onclick="busca_endereco('edita_aluno');">
                                            <i class="fa fa-search">Buscar</i>                                            
                                        </button>
                                    </div><!-- /btn-group -->                                            
                                </div>
                            </div>

                    <div class="col-lg-3 col-md-3">
                        <label for="">UF*</label>
                        <input type="text" class="form-control" name="ds_uf" id="ds_uf" value="<?= $aluno->ds_uf; ?>" required="true">
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <label for="">Rua*</label>
                        <input type="text" class="form-control" name="ds_endereco" id="ds_endereco" value="<?= $aluno->ds_endereco; ?>" required="true">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <label for="">Bairro*</label>
                        <input type="text" class="form-control" name="ds_bairro" id="ds_bairro" value="<?= $aluno->ds_bairro; ?>" required="true">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <label for="">Cidade*</label>
                        <input type="text" class="form-control" name="ds_cidade" id="ds_cidade" value="<?= $aluno->ds_cidade; ?>" required="true">
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <label for="">Complemento</label>
                        <input type="text" class="form-control" name="ds_complemento" id="ds_complemento" value="<?= $aluno->ds_complemento; ?>">
                    </div>
                    
                    <div class="col-lg-12 col-md-12"><br>
                        <center>
                            <button type="submit" class="btn btn-success"><i class="fa fa-search">Salvar</button>
                            <button type="button" class="btn btn-danger" onclick="excluir(<?= $aluno->cd_aluno; ?>)"><i class="fa fa-search">Excluir</button>    
                            <a href="/trabalho-uniasselvi/projeto.view/alunos/consulta_alunos.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                        </center>
                    </div> 
                </div>
            </form>
            <script type="text/javascript">

                function busca_endereco(form_name){
                    var cep = document.getElementById(form_name).nr_cep.value;
                    
                    if(cep == ""){
                        alert("Informe o CEP para pesquisa!");
                    }
                    else{
                        $.get("../geral/busca_cep.php?cep="+cep, function( data ) {
                            var resultado = data;
                            
                            var listResultado = resultado.split(';');
                            var ds_uf       = listResultado[0];
                            var ds_cidade   = listResultado[1];
                            var ds_bairro   = listResultado[2];
                            var ds_endereco = listResultado[3];                        

                            document.getElementById(form_name).ds_uf.value          = ds_uf;
                            document.getElementById(form_name).ds_cidade.value      = ds_cidade;
                            document.getElementById(form_name).ds_bairro.value      = ds_bairro;
                            document.getElementById(form_name).ds_endereco.value    = ds_endereco;
                        });
                    }
                }

                function excluir(cd_aluno){
                    if(confirm("Deseja realmente excluir este aluno?")){
                        window.location = 'alunos_man.php?cd_aluno='+cd_aluno+'&evento=excluir';
                    }
                }
            </script>
        </main>
        

        <?php
    }
}

?>
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


                    <div class="col-lg-6 col-md-6">
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
                        <input type="text" class="form-control" name="ds_endereco" id="inputEndereco" required="true">
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
}

?>
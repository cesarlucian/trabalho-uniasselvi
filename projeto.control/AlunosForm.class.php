<?php

class AlunosForm {

    static function pesquisaModal(){
     
        ?>  
            <main class="card-padrao">
                <form action="../popups/popup_alunos.php" method="GET" name="pesquisa" role="form"> 
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <label>Pesquisar aluno</label>
                            <input type="text" name="filtro" id="filtro" class="form-control">
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

	static function pesquisa(){
     
        ?>  
            <main class="card-padrao">

                <form action="../alunos/index.php" method="GET" name="pesquisa" role="form"> 
                    <h3 class="title">Alunos</h3><br>
                    <div class="row">
                        <div id="div_filtro" class="col-md-2 col-lg-2">
                            <label>Filtro:</label>
                            <select id="filtro" name="filtro" class="form-control" onchange="buscaFiltro();">
                                <option value="1" selected="selected">Nome</option>
                                <option value="3">Matr&iacute;cula</option>
                                <option value="2">Curso</option>
                            </select>
                        </div>

                        <div id="pesquisa_filtro" class="col-md-10 col-lg-10">
                            <label>Pesquisar</label>
                            <div class="input-button-inline">
                                <input type="text" name="pesquisa_filtro" id="pesquisa_filtro" class="form-control">
                            </div>
                        </div>

                    </div> 
                    <div class="col-md-12 col-lg-12">
                        <center><br>
                            <button type="submit" class="btn btn-primary mx-3"><i class="fa fa-search">Pesquisar</button>
                        </center>
                    </div>
                </form>
                <script>
                </script>
            </main>
        <?php
    }

    static function novoAluno() {
        ?>

        
            <section class="content">
        <div class="nav-tabs-custom">
                <main class="card-padrao">
                    <form name="novo_aluno" id="novo_aluno" action="../alunos/alunos_man.php" method="POST">
                        <h3 class="box-title">Cadastro de aluno</h3><br>
                        <input type="hidden" name="evento" id="evento" value="novo_aluno" />
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#div_dados_cadastrais" data-toggle="tab">Dados cadastrais</a></li>
                            <li><a href="#div_endereco" data-toggle="tab">Endere&ccedil;o</a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="div_dados_cadastrais">
                                <br><div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <label for="">Nome*</label>
                                            <input type="text" class="form-control" name="ds_nome" id="ds_nome" required="true">
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="">Email*</label>
                                            <input type="email" class="form-control" name="ds_email" id="ds_email" required="true">
                                        </div>
                                        </div>
                                    <br><div class="row">
                                        <div class="col-lg-2 col-md-2">
                                            <label for="">Data de nascimento*</label>
                                            <input class="form-control" type="date" name="dt_nascimento" id="dt_nascimento" required="true">
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <label for="">Sexo*</label>
                                            <select id="ds_sexo" name="ds_sexo" class="form-control" required="true">
                                                <option value=""></option>
                                                <option value="M">Masculino</option>
                                                <option value="F">Feminino</option>
                                                <option value="O">Outros</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <label for="">CPF*</label>
                                            <input type="text" class="form-control" name="nr_cpf" id="nr_cpf" required="true">
                                        </div>
                                        <div id="popup_curso" class="col-lg-3 col-md-3">
                                            <label>Curso*</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="ds_curso" name="ds_curso" readonly="true"/>
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" onclick="popUpCurso('novo_aluno');">
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
                                                        <button type="button" class="btn btn-primary" onclick="popUpTurma('novo_aluno');">
                                                                <i class="fa fa-search"></i>
                                                                Buscar
                                                        </button>
                                                    </div>                                        
                                                </div>
                                            <input type="hidden" class="form-control" id="cd_turma" name="cd_turma">
                                        </div>
                                    </div>
                                </div>
                            <div class="tab-pane" id="div_endereco">

                                <br><div class="row">
                                       <div class="col-lg-3 col-md-3">
                                            <label for="">CEP*</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="nr_cep" name="nr_cep" required="true">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" onclick="busca_endereco('novo_aluno');">
                                                        <i class="fa fa-search">Buscar</i>                                            
                                                    </button>
                                                </div>                                        
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-9">
                                            <label for="">Rua*</label>
                                            <input type="text" class="form-control" name="ds_endereco" id="ds_endereco" required="true">
                                        </div>
                                    </div>

                                    <br><div class="row">
                                        <div class="col-lg-3 col-md-3">
                                            <label for="">Bairro*</label>
                                            <input type="text" class="form-control" name="ds_bairro" id="ds_bairro" required="true">
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <label for="">Cidade*</label>
                                            <input type="text" class="form-control" name="ds_cidade" id="ds_cidade" required="true">
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <label for="">UF*</label>
                                            <input type="text" class="form-control" name="ds_uf" id="ds_uf" required="true">
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <label for="">N&uacute;mero*</label>
                                            <input type="number" class="form-control" name="nr_endereco" id="nr_endereco" required="true">
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <label for="">Complemento</label>
                                            <input type="text" class="form-control" name="ds_complemento" id="ds_complemento">
                                        </div>

                                    </div>
                                </div>
                            <div class="col-lg-12 col-md-12"><br>
                            <center>
                                <button type="submit" class="btn btn-success" onclick="return aviso();"><i class="fa fa-search">Cadastrar</button>
                                <a href="/trabalho-uniasselvi/projeto.view/alunos/index.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                            </center>
                        </div> 
                        </div>
                    </form>
                </main>
        </div>
            </section>
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

            function popUpCurso(form){

                window.open('../geral/popups/popup_cursos.php?form='+form, 'JANELA', 'width=800, height=600');
            }

            function popUpTurma(form){

                var cd_curso = document.novo_aluno.cd_curso.value;

                if(cd_curso == "") {

                    alert("Selecione um curso!");
                    return false;

                } else {

                    window.open('../geral/popups/popup_turmas.php?form='+form+'&cd_curso='+cd_curso,'JANELA', 'width=800, height=600');

                }
                
            }

            function aviso() {

                var ds_curso    = document.getElementById('ds_curso').value;
                var nr_turma    = document.getElementById('nr_turma').value;
                var nr_cep      = document.getElementById('nr_cep').value;
                var ds_endereco = document.getElementById('ds_endereco').value;
                var ds_bairro   = document.getElementById('ds_bairro').value;
                var ds_cidade   = document.getElementById('ds_cidade').value;
                var ds_uf       = document.getElementById('ds_uf').value;
                var nr_endereco = document.getElementById('nr_endereco').value;

                var ds_nome       = document.getElementById('ds_nome').value;
                var dt_nascimento = document.getElementById('dt_nascimento').value;
                var ds_sexo       = document.getElementById('ds_sexo').value;
                var nr_cpf        = document.getElementById('nr_cpf').value;
                var ds_curso      = document.getElementById('ds_curso').value;
                var nr_turma      = document.getElementById('nr_turma').value;

                if(!ds_nome || !dt_nascimento || !ds_sexo || !nr_cpf || !ds_curso || !nr_turma) {

                    alert("Preencha todos campos obrigat\u00f3rios dos dados cadastrais!");
                    return false;

                } else if(!ds_curso || !nr_turma || !nr_cep || !ds_endereco || !ds_bairro || !ds_cidade || !ds_uf || !nr_endereco) {

                    alert("Preencha todos campos obrigat\u00f3rios do endere\u00e7o!");
                    return false;
                }

            }

            

                
        </script>
                
        <?php
    }

    static function editaAluno($cd_aluno) {

            $aluno = new Alunos();
            $aluno->getObject($cd_aluno);

            $curso = new Cursos();
            $curso->getObject($aluno->cd_curso);

            $turma = new Turmas();
            $turma->getObject($aluno->cd_turma);

            $desc_status = null;
            $desc_sexo = null;

            if($aluno->fg_status == "A") {
                $desc_status = "Ativo";
            } else {
                $desc_status = "Inativo";
            }

            if($aluno->ds_sexo == "M") {
                $desc_sexo = "Masculino";
            } else if($aluno->ds_sexo == "F") {
                $desc_sexo = "Feminino";
            } else if($aluno->ds_sexo == "O") {
                $desc_sexo = "Outros";
            }
        ?>
        <div class="nav-tabs-custom">
            <main class="card-padrao">
                <form class="form" name="edita_aluno" id="edita_aluno" action="../alunos/alunos_man.php" method="POST">
                    <h3 class="title">Editar aluno</h3><br>
                    <input type="hidden" name="cd_aluno" id="cd_aluno" value="<?= $aluno->cd_aluno; ?>" />
                    <input type="hidden" name="evento" id="evento" value="edita_aluno" />
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#div_dados_cadastrais" data-toggle="tab">Dados cadastrais</a></li>
                            <li><a href="#div_endereco" data-toggle="tab">Endere&ccedil;o</a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="div_dados_cadastrais">

                                <br><div class="row">
                                        <div id="situacao" class="col-md-2 col-lg-2">
                                            <label for="fg_status">Situa&ccedil;&atilde;o</label>
                                            <select class="form-control" id="fg_status" name="fg_status">
                                                <option value="<?= $aluno->fg_status; ?>" selected="selected"><?= $desc_status; ?></option>
                                                <?php if($aluno->fg_status == "A") { ?>
                                                    <option value="I">Inativo</option>
                                                <?php } else { ?> 
                                                    <option value="A">Ativo</option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <label for="">Nome*</label>
                                            <input type="text" class="form-control" name="ds_nome" id="ds_nome" required="true" value="<?= $aluno->nm_principal; ?>">
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <label for="">Email*</label>
                                            <input type="email" class="form-control" name="ds_email" id="ds_email" required="true" value="<?= $aluno->ds_email; ?>">
                                        </div>
                                        </div>
                                    <br><div class="row">
                                        <div class="col-lg-2 col-md-2">
                                            <label for="">Data de nascimento*</label>
                                            <input class="form-control" type="date" name="dt_nascimento" id="dt_nascimento" required="true" value="<?= $aluno->dt_nascimento; ?>">
                                        </div>
                                    
                                    
                                        <div class="col-lg-2 col-md-2">
                                            <label for="">Sexo*</label>
                                            <select id="ds_sexo" name="ds_sexo" class="form-control" required="true">

                                                <option value="<?= $aluno->ds_sexo; ?>" selected="selected"><?= $desc_sexo; ?></option>

                                                <?php if($aluno->ds_sexo == "M") { ?>
                                                    <option value="F">Feminino</option>
                                                    <option value="O">Outros</option>

                                                <?php } else if($aluno->ds_sexo == "F") { ?>
                                                    <option value="M">Masculino</option>
                                                    <option value="O">Outros</option>
                                                <?php } else { ?>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Feminino</option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <label for="">CPF*</label>
                                            <input type="text" class="form-control" name="nr_cpf" id="nr_cpf" required="true" value="<?= Geral::getCpfFormatado($aluno->nr_cpf); ?>">
                                        </div>
                                        <div id="popup_curso" class="col-lg-3 col-md-3">
                                            <label>Curso*</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="ds_curso" name="ds_curso" readonly="true" value="<?= $curso->ds_curso; ?>"/>
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" onclick="popUpCurso('edita_aluno');">
                                                        <i class="fa fa-search"></i>
                                                        Buscar
                                                    </button>
                                                </div>                                        
                                            </div>
                                            <input type="hidden" class="form-control" id="cd_curso" name="cd_curso" value="<?= $curso->cd_curso; ?>">
                                        </div>
                                        <div id="popup_turma" class="col-lg-3 col-md-3">
                                            <label>Turma*</label>
                                            <div class="input-group">
                                                    <input type="text" class="form-control" id="nr_turma" name="nr_turma" readonly="true" value="<?= $turma->nr_turma; ?>"/>
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-primary" onclick="popUpTurma('edita_aluno');">
                                                                <i class="fa fa-search"></i>
                                                                Buscar
                                                        </button>
                                                    </div>                                        
                                                </div>
                                            <input type="hidden" class="form-control" id="cd_turma" name="cd_turma" value="<?= $turma->cd_turma; ?>">
                                        </div>
                                    </div>
                                </div>
                            <div class="tab-pane" id="div_endereco">

                                <br><div class="row">

                                       <div class="col-lg-3 col-md-3">
                                            <label for="">CEP*</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="nr_cep" name="nr_cep" required="true" value="<?= $aluno->nr_cep; ?>">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" onclick="busca_endereco('novo_aluno');">
                                                        <i class="fa fa-search">Buscar</i>                                            
                                                    </button>
                                                </div>                                        
                                            </div>
                                        </div>

                                        <div class="col-lg-9 col-md-9">
                                            <label for="">Rua*</label>
                                            <input type="text" class="form-control" name="ds_endereco" id="ds_endereco" required="true" value="<?= $aluno->ds_endereco; ?>">
                                        </div>
                                    </div>
                                    <br><div class="row">
                                        <div class="col-lg-3 col-md-3">
                                            <label for="">Bairro*</label>
                                            <input type="text" class="form-control" name="ds_bairro" id="ds_bairro" required="true" value="<?= $aluno->ds_bairro; ?>">
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <label for="">Cidade*</label>
                                            <input type="text" class="form-control" name="ds_cidade" id="ds_cidade" required="true" value="<?= $aluno->ds_cidade; ?>">
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <label for="">UF*</label>
                                            <input type="text" class="form-control" name="ds_uf" id="ds_uf" required="true" value="<?= $aluno->ds_uf; ?>">
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <label for="">N&uacute;mero*</label>
                                            <input type="number" class="form-control" name="nr_endereco" id="nr_endereco" required="true" value="<?= $aluno->nr_endereco; ?>">
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <label for="">Complemento</label>
                                            <input type="text" class="form-control" name="ds_complemento" id="ds_complemento" value="<?= $aluno->ds_complemento; ?>">
                                        </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12"><br>
                            <center>
                                <button type="submit" class="btn btn-success" onclick="return aviso();"><i class="fa fa-search">Salvar</button>
                                <a href="/trabalho-uniasselvi/projeto.view/alunos/index.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                            </center>
                        </div> 
                        </div>
                        </form>
                    </main>
            </div>
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

            function popUpCurso(form){

                window.open('../geral/popups/popup_cursos.php?form='+form, 'JANELA', 'width=800, height=600');
            }

            function popUpTurma(form){

                var cd_curso = document.edita_aluno.cd_curso.value;

                if(cd_curso == "") {

                    alert("Selecione um curso!");
                    return false;

                } else {

                    window.open('../geral/popups/popup_turmas.php?form='+form+'&cd_curso='+cd_curso,'JANELA', 'width=800, height=600');

                }
                
            }

            function aviso() {

                var ds_curso    = document.getElementById('ds_curso').value;
                var nr_turma    = document.getElementById('nr_turma').value;
                var nr_cep      = document.getElementById('nr_cep').value;
                var ds_endereco = document.getElementById('ds_endereco').value;
                var ds_bairro   = document.getElementById('ds_bairro').value;
                var ds_cidade   = document.getElementById('ds_cidade').value;
                var ds_uf       = document.getElementById('ds_uf').value;
                var nr_endereco = document.getElementById('nr_endereco').value;

                var ds_nome       = document.getElementById('ds_nome').value;
                var dt_nascimento = document.getElementById('dt_nascimento').value;
                var ds_sexo       = document.getElementById('ds_sexo').value;
                var nr_cpf        = document.getElementById('nr_cpf').value;
                var ds_curso      = document.getElementById('ds_curso').value;
                var nr_turma      = document.getElementById('nr_turma').value;

                if(!ds_nome || !dt_nascimento || !ds_sexo || !nr_cpf || !ds_curso || !nr_turma) {

                    alert("Preencha todos campos obrigat\u00f3rios dos dados cadastrais!");
                    return false;

                } else if(!ds_curso || !nr_turma || !nr_cep || !ds_endereco || !ds_bairro || !ds_cidade || !ds_uf || !nr_endereco) {

                    alert("Preencha todos campos obrigat\u00f3rios do endere\u00e7o!");
                    return false;
                }
        </script>
        
        <?php
    }
}

?>
<?php 

class UsuariosForm {

    static function pesquisa(){
     
        ?>  
            <main class="card-padrao">
                <form action="../usuarios/index.php" method="GET" id="pesquisa" name="pesquisa" role="form"> 
                    <h3 class="title">Usu&aacute;rios</h3><br>
                    <div class="row">

                    	<div id="filtro" class="col-md-2 col-lg-2">
                    		<label for="filtro">Filtro:</label>
                    		<select id="filtro" name="filtro" class="form-control">
                    			<option value="1" selected="selected">Nome</option>
                    			<option value="2">Login</option>
                    		</select>
                    	</div>

                        <div id="pesquisa_filtro" class="col-md-10 col-lg-10">
                            <label for="pesquisa_filtro">Pesquisar</label>
                            <div class="input-button-inline">
                                <input type="text" name="pesquisa_filtro" id="pesquisa_filtro" placeholder="Pesquisar..." class="form-control"> 
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
            <form action="../usuarios/usuarios_man.php" method="POST" id="novo_usuario" name="novo_usuario" role="form">
                <input type="hidden" name="evento" id="evento" value="novo_usuario">
                <h3 class="box-title">Cadastro de usu&aacute;rio</h3><br>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                    </div>
                </div>
                    <div class="row">
    	                <div id="nm_usuario" class="col-md-6 col-lg-6">
    	                	<label for="nm_usuario">Nome*</label>
    	                	<input type="text" name="nm_usuario" id="nm_usuario" class="form-control" placeholder="Nome" required="true">
    	                </div>

    	                <div id="ds_login" class="col-md-6 col-lg-6">
    	                	<label for="ds_login">Login*</label> 
    	                	<input type="text" name="ds_login" id="ds_login" class="form-control" placeholder="Login" maxlength="20" required="true">
     	                </div>
                    </div><br>

                    <div class="row">
     	                <div id="ds_email" class="col-md-6 col-lg-6">
     	                	<label for="ds_email">E-mail*</label>
     	                	<input type="email" name="ds_email" id="ds_email" class="form-control" placeholder="E-mail" required="true">
     	                </div>

     	                <div id="ds_cargo" class="col-md-6 col-lg-6">
     	                	<label for="ds_cargo">Cargo*</label>
     	                	<?= CargosForm::campoSelect(); ?>
     	                </div>
                    </div>
                
                <div class="col-lg-12 col-md-12"><br>
                    <center>
                        <button type="submit" class="btn btn-success" onclick="return aviso();"><i class="fa fa-search">Cadastrar</button>
                        <a href="/trabalho-uniasselvi/projeto.view/usuarios/index.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                    </center>
                </div> 
            </form>
        </main>
        <script>
           
        </script>

        <?php
    }

     static function alteraSenha() {

        $usuario = new Usuarios;
        $usuario->getObject($cd_usuario);
        
        $nome_usuario = Geral::removeAcentos($usuario->nm_usuario);
        $quebra_nome = explode(" ", $nome_usuario);
        $nome_padrao_login = $quebra_nome[0];            
        $senha_default = '@'.$nome_padrao_login.'123';

        ?>

            <main class="card-padrao">
                <form name="form_senha" id="form_senha" action="../usuarios/usuarios_man.php" method="POST" id="altera_senha" name="altera_senha" role="form">
                    <input type="hidden" name="evento" id="evento" value="altera_senha">
                    <input type="hidden" name="cd_usuario" id="cd_usuario" value="<?= $_SESSION['usuario']->cd_usuario; ?>">
                    <h3 class="box-title">Alterar senha</h3><br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                        </div>
                    </div>
                        <div class="row">
                            <div id="nm_usuario" class="col-md-3 col-lg-3">
                                <label for="nova_senha">Nova senha*</label>
                                <input type="password" name="nova_senha" id="nova_senha" placeholder="Nova senha" class="form-control" required="true">
                            </div>
                            <div id="nm_usuario" class="col-md-3 col-lg-3">
                                <label for="confirma_nova_senha">Confirmar senha*</label>
                                <input type="password" name="confirma_nova_senha" id="confirma_nova_senha" placeholder="Confirmar senha" class="form-control" required="true">
                            </div>
                        </div>
                    <div class="col-lg-12 col-md-12"><br>
                        <center>
                            <button type="submit" onclick="salvar('')" class="btn btn-success"><i class="fa fa-search">Salvar</button>
                            <a href="../../inicial.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                        </center>
                    </div> 
                </form>
                <script>
                    function salvar(){
                        var confirma_nova_senha = document.form_senha.confirma_nova_senha.value;
                        var nova_senha = document.form_senha.nova_senha.value;
                        
                        if(nova_senha == "<?= strtolower($senha_default); ?>"){
                            alert('A senha padr\u00e3o deve ser modificada.');
                            return false;    

                        }

                        var validaSenha = isOkPass(nova_senha);

                        if(nova_senha != confirma_nova_senha){
                            alert("Confirma\u00e7\u00e3o de senha incorreta!");                       
                        } else{
                            if(validaSenha.result){
                                document.form_senha.submit();
                            }
                            else{
                                alert(validaSenha.error);
                            }
                        }                                        
                    }

                    function isOkPass(p){
                        var alpha = /[a-zA-Z]/; 
                        var aNumber = /[0-9]/;
                        var aSpecial = /[!|@|#|$|%|^|&|*|(|)|-|_]/;
                        var obj = {};
                        obj.result = true;

                        if(p.length < 8){                        
                            obj.result=false;
                            obj.error="A senha deve conter no minimo 8 digitos!"
                            return obj;
                        }

                        var numAlpha = 0;
                        var numNums = 0;
                        var numSpecials = 0;
                        for(var i=0; i<p.length; i++){
                            if(alpha.test(p[i]))
                                numAlpha++;
                            else if(aNumber.test(p[i]))
                                numNums++;
                            else if(aSpecial.test(p[i]))
                                numSpecials++;
                        }

                        if(numNums < 2 || numAlpha < 2 || numSpecials < 1){
                            obj.result=false;
                            obj.error="A senha deve conter 1 caracter especial, no minimo 2 numeros e 2 letras!";
                            return obj;
                        }
                        return obj;
                    }
                </script>
            </main>

        <?php
    }

    static function edita($cd_usuario) {

        $usuario = new Usuarios();
        $usuario->getObject($cd_usuario);

        if($usuario->fg_status == "A") {
                $desc_status = "Ativo";
            } else {
                $desc_status = "Inativo";
            }

        ?>

        <main class="card-padrao">
            <form action="../usuarios/usuarios_man.php" method="POST" id="edita_usuario" name="edita_usuario" role="form">
                <input type="hidden" name="evento" id="evento" value="edita_usuario">
                <input type="hidden" name="cd_usuario" id="cd_usuario" value="<?= $usuario->cd_usuario; ?>">
                <h3 class="box-title">Editar usu&aacute;rio</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                    </div>
                </div>

                    <div class="row">
                        <div id="situacao" class="col-md-2 col-lg-2">
                            <label for="fg_status">Situa&ccedil;&atilde;o*</label>
                            <select class="form-control" id="fg_status" name="fg_status">
                                <option value="<?= $usuario->fg_status; ?>" selected="selected"><?= $desc_status; ?></option>
                                <?php if($usuario->fg_status == "A") { ?>
                                    <option value="I">Inativo</option>
                                <?php } else { ?> 
                                    <option value="A">Ativo</option>
                                <?php } ?>
                            </select>
                        </div>
                    
    	                <div id="nm_usuario" class="col-md-10 col-lg-10">
    	                	<label for="nm_usuario">Nome*</label>
    	                	<input type="text" name="nm_usuario" id="nm_usuario" class="form-control" placeholder="Nome" value="<?= $usuario->nm_usuario; ?>" required="true">
    	                </div>
                    </div>

                    <br><div class="row">

                        <div id="ds_email" class="col-md-7 col-lg-7">
                            <label for="ds_email">E-mail*</label>
                            <input type="email" name="ds_email" id="ds_email" class="form-control" placeholder="E-mail" value="<?= $usuario->ds_email; ?>" required="true">
                        </div>

    	                <div id="ds_login" class="col-md-3 col-lg-3">
    	                	<label for="ds_login">Login*</label> 
    	                	<input type="text" name="ds_login" id="ds_login" class="form-control" placeholder="Login" maxlength="20" value="<?= $usuario->ds_login; ?>" required="true">
     	                </div>

                        <div id="ds_cargo" class="col-md-2 col-lg-2">
                            <label for="ds_cargo">Cargo*</label>
                            <?= CargosForm::campoSelectEdita($usuario->cd_usuario); ?>
                        </div>

                        <div class="checkbox col-lg-12 col-md-12"> 
                                <br><label for="check_box">
                                    <input type="checkbox" id="check_box" name="check_box">Alterar para senha padr&atilde;o
                                </label>
                        </div>

                    </div>

                <div class="col-lg-12 col-md-12"><br>
                    <center>
                        <button type="submit" class="btn btn-success"><i class="fa fa-search">Salvar</button>
                            <button type="button" class="btn btn-danger" onclick="excluir('<?= $usuario->cd_usuario; ?>');"><i class="fa fa-search">Excluir</button>
                        <a href="/trabalho-uniasselvi/projeto.view/usuarios/index.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                    </center>
                </div> 
            </form>
        </main>
        <script type="text/javascript">
           function excluir(cd_usuario){
                if(confirm("Deseja realmente excluir este usu\u00e1rio?")){
                    window.location = 'usuarios_man.php?evento=excluir&cd_usuario='+cd_usuario;
                }
            }
        </script>

        <?php
    	}
	}

?>
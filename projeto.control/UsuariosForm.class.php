<?php 

class UsuariosForm {

    static function pesquisa(){
     
        ?>  
            <main class="card-padrao">
                <form action="../usuarios/index.php" method="GET" id="pesquisa" name="pesquisa" role="form"> 
                    <h3 class="title">Usu&aacute;rios</h3><br>
                    <div class="row">

                    	<div id="filtro" class="col-md-2 col-lg-2">
                    		<label>Filtro:</label>
                    		<select id="filtro" name="filtro" class="form-control">
                    			<option value="1" selected="selected">Nome</option>
                    			<option value="2">Login</option>
                    		</select>
                    	</div>

                        <div id="pesquisa_filtro" class="col-md-10 col-lg-10">
                            <label>Pesquisar</label>
                            <div class="input-button-inline">
                                <input type="text" name="pesquisa_filtro" id="pesquisa_filtro" class="form-control"> 
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
    	                	<label for="nm_usuario">Nome</label>
    	                	<input type="text" name="nm_usuario" id="nm_usuario" class="form-control" required="true">
    	                </div>

    	                <div id="ds_login" class="col-md-6 col-lg-6">
    	                	<label for="ds_login">Login</label> 
    	                	<input type="text" name="ds_login" id="ds_login" class="form-control" maxlength="20" required="true">
     	                </div>
                    </div>

                    <div class="row">
     	                <div id="ds_email" class="col-md-6 col-lg-6">
     	                	<label for="ds_email">E-mail</label>
     	                	<input type="email" name="ds_email" id="ds_email" class="form-control" required="true">
     	                </div>

     	                <div id="ds_cargo" class="col-md-6 col-lg-6">
     	                	<label for="ds_cargo">Cargo</label>
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
        </script>

        <?php
    }

     static function alteraSenha() {
        ?>

            <main class="card-padrao">
                <form action="../usuarios/usuarios_man.php" method="POST" id="troca_senha" name="troca_senha" role="form">
                    <input type="hidden" name="evento" id="evento" value="troca_senha">
                    <h3 class="box-title">Teste troca senha</h3><br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                        </div>
                    </div>
                        <div class="row">
                            <div id="nm_usuario" class="col-md-6 col-lg-6">
                                <label for="nm_usuario">Teste</label>
                                <input type="text" name="nm_usuario" id="nm_usuario" class="form-control" required="true">
                            </div>
                        </div>
                    
                    <div class="col-lg-12 col-md-12"><br>
                        <center>
                            <button type="submit" class="btn btn-success"><i class="fa fa-search">Alterar</button>
                            <a href="trabalho-uniasselvi/inicial.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                        </center>
                    </div> 
                </form>
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
                <h3 class="box-title">Editar usu&aacute;rio</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                    </div>
                </div>

                    <div class="row">
                        <div id="situacao" class="col-md-2 col-lg-2">
                            <label for="fg_status">Situa&ccedil;&atilde;o</label>
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
    	                	<label for="nm_usuario">Nome</label>
    	                	<input type="text" name="nm_usuario" id="nm_usuario" class="form-control" value="<?= $usuario->nm_usuario; ?>" required="true">
    	                </div>
                    </div>

                    <br><div class="row">

                        <div id="ds_email" class="col-md-7 col-lg-7">
                            <label for="ds_email">E-mail</label>
                            <input type="email" name="ds_email" id="ds_email" class="form-control" value="<?= $usuario->ds_email; ?>" required="true">
                        </div>

    	                <div id="ds_login" class="col-md-3 col-lg-3">
    	                	<label for="ds_login">Login</label> 
    	                	<input type="text" name="ds_login" id="ds_login" class="form-control" maxlength="20" value="<?= $usuario->ds_login; ?>" required="true">
     	                </div>

                        <div id="ds_cargo" class="col-md-2 col-lg-2">
                            <label for="ds_cargo">Cargo</label>
                            <?= CargosForm::campoSelectEdita($usuario->cd_usuario); ?>
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
            
            function excluir(cd_usuario){
                if(confirm("Deseja realmente excluir este curso?")){
                    window.location = 'usuarios_man.php?evento=excluir&cd_usuario='+cd_usuario;
                }
            }
        </script>

        <?php
    	}
	}

?>
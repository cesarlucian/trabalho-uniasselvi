<?php

class LoginForm {

	static function login() {

		?>
		
		<br><main class="card-padrao">
		    <form action="login.php" name="login" id="login" class="login d-flex align-items-center flex-column justify-content-center" method="POST">
		        <h3 class="title">Bem vindo(a)!</h3><br> 
		        <div class="row">
		            <div class="col-lg-12 col-md-12">
		                <label for="ds_login">Usu&aacute;rio</label>
		                <div class="input-button-inline">
		                    <input alt="Insira seu usu&aacute;rio" title="Insira seu usu&aacute;rio" type="text" class="form-control" id="ds_login" name="ds_login" placeholder="Usu&aacute;rio" required="true"/>
		                </div>
		            </div>
		           <div class="col-lg-12 col-md-12">
		           	<div id="divMayus" style="visibility:hidden"><span style="color: #f00;">CAPS LOCK est&aacute; ligado!</span></div> 
		                <label for="password">Senha</label>
		                 <div class="input-button-inline">
		                    <input alt="Insira sua senha" title="Insira sua senha" type="password" class="form-control" id="ds_senha" name="ds_senha" placeholder="Senha" autocomplete="on" onkeypress="capLock(event)" required="true" />                           
		                </div>
		            </div>
		        </div> 

		        <div class="col-lg-12 col-md-12">
		        	<center><br>
		            	<button class="btn btn-success" type="submit" >Entrar</button>
		        	</center>
		        </div><br>

		        
		    </form>
		    <script>
		 
				function capLock(e){
					kc = e.keyCode?e.keyCode:e.which;
					sk = e.shiftKey?e.shiftKey:((kc == 16)?true:false);
					if(((kc >= 65 && kc <= 90) && !sk)||((kc >= 97 && kc <= 122) && sk))
					document.getElementById('divMayus').style.visibility = 'visible';
					else
					document.getElementById('divMayus').style.visibility = 'hidden';
				}
			
		    </script>
		</main>

		<?php
	}

	static function novaSenha($cd_usuario) {

		$usuario = new Usuarios();
		$usuario->getObject($cd_usuario);

		$nome_usuario = Geral::removeAcentos($usuario->nm_usuario);
		$quebra_nome = explode(" ", $nome_usuario);
		$primeiro_nome = $quebra_nome[0];

		$senha_default = "@".$primeiro_nome."123";

		?>

		<br><main class="card-padrao">
		    <form id="nova_senha" name="nova_senha" action="/trabalho-uniasselvi/projeto.view/usuarios/usuarios_man.php" class="login d-flex align-items-center flex-column justify-content-center" method="POST">
		    	<input type="hidden" name="evento" id="evento" value="nova_senha">
		    	<input type="hidden" name="cd_usuario" id="cd_usuario" value="<?= $usuario->cd_usuario; ?>">
		        <h3 class="title">Altere sua senha</h3><br> 
		        <div class="row">
		        	<div class="col-lg-12 col-md-12">
                        <label>Sua senha est&aacute; como padr&atilde;o, altere e faça login novamente.</label><br>
                    </div>
                </div>
		        <div class="row">
		           <div id="divMayus" class="col-lg-12 col-md-12" style="visibility:hidden"><span style="color: #f00;">CAPS LOCK est&aacute; ligado!</span></div> 
		            <div class="col-lg-12 col-md-12">
		                <label for="nova_senha">Nova senha*</label>
		                 <div class="input-button-inline">
		                    <input alt="Insira sua nova senha" title="Insira sua nova senha" type="password" class="form-control" id="nova_senha" name="nova_senha" placeholder="Nova senha" autocomplete="on" onkeypress="capLock(event)" required="true" />                           
		                </div>
		            </div>

		            <div class="col-lg-12 col-md-12">
		                <br><label for="confirma_nova_senha">Confirmar senha*</label>
		                 <div class="input-button-inline">
		                    <input alt="Confirmar senha" title="Confirmar senha" type="password" class="form-control" id="confirma_nova_senha" name="confirma_nova_senha" placeholder="Confirmar senha" autocomplete="on" onkeypress="capLock(event)" required="true" />                           
		                </div>
		            </div>

		        </div> 

		        <div class="col-lg-12 col-md-12">
		        	<center><br>
		            	<button class="btn btn-success" onclick="salvar('')" type="submit" >Alterar</button>
		        	</center>
		        </div><br>

		    </form>
		    <script>

		    	function salvar(){
                        var confirma_nova_senha = document.nova_senha.confirma_nova_senha.value;
                        var nova_senha = document.nova_senha.nova_senha.value;
                        
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
		 
				function capLock(e){
					kc = e.keyCode?e.keyCode:e.which;
					sk = e.shiftKey?e.shiftKey:((kc == 16)?true:false);
					if(((kc >= 65 && kc <= 90) && !sk)||((kc >= 97 && kc <= 122) && sk))
					document.getElementById('divMayus').style.visibility = 'visible';
					else
					document.getElementById('divMayus').style.visibility = 'hidden';
				}
			
		    </script>
		</main>

		<?php
	}
}

?>
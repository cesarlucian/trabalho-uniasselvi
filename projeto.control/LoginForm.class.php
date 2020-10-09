<?php

class LoginForm {

	static function novo() {

		?>
		
		<br><main class="card-padrao">
		    <form action="login.php" class="login d-flex align-items-center flex-column justify-content-center" method="POST">
		        <h3 class="title">Bem vindo(a)!</h3><br> 
		        <div class="row">
		            <div class="col-lg-12 col-md-12">
		                <label for="ds_login">Usu&aacute;rio</label>
		                <div class="input-group">
		                    <input alt="Insira seu usu&aacute;rio" title="Insira seu usu&aacute;rio" type="text" class="form-control" id="ds_login" name="ds_login" placeholder="Usu&aacute;rio" required="true"/>                                    
		                </div>
		            </div>
		           <div class="col-lg-12 col-md-12 mt-3">
		           	<div id="divMayus" style="visibility:hidden"><span style="color: #f00;">CAPS LOCK est&aacute; ligado!</span></div> 
		                <label for="password">Senha</label>
		                 <div class="input-button-inline">
		                    <input alt="Insira sua senha" title="Insira sua senha" type="password" class="form-control" id="ds_senha" name="ds_senha" placeholder="Senha" autocomplete="on" onkeypress="capLock(event)"  required="true"/>
		                    <input class="btn btn-primary" type="button" id="showPassword" value="Mostrar" class="button" />                             
		                </div>
		            </div>
		        </div> 

		        <div class="col-lg-12 col-md-12">
		        	<center><br>
		            	<button class="btn btn-success" type="submit" >Entrar</button>
		        	</center>
		        </div><br>

		        <div class="d-flex justify-content-between">
				      <div>
				        <div class="col-lg-12 col-md-12" align="right">
		        			<a href="/trabalho-uniasselvi/nova_senha.php">Esqueci minha senha</a>
		    			</div>
				      </div>
				      <div>
				        <div class="col-lg-12 col-md-12" align="left">
		        			<a href="/trabalho-uniasselvi/novo_usuario.php">Esqueci meu usu&aacute;rio</a>
		    			</div>
				      </div>
				 </div>
		        
		        

		    	

		    </form>
		    <script>
		        $(document).ready(function(){
		 
		          $('#showPassword').on('click', function() {
		             
		            var passwordField = $('#ds_senha');
		            var passwordFieldType = passwordField.attr('type');
		         
		            if(passwordFieldType == 'password') {

		                passwordField.attr('type', 'text');
		                $(this).val('Ocultar');

		            } else {

		                passwordField.attr('type', 'password');
		                $(this).val('Mostrar');
		            }
		          });
		        });

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

	static function novaSenha() {

		?>
		
		<br><main class="card-padrao">
		    <form action="projeto.view/usuarios/usuarios_man.php" class="login d-flex align-items-center flex-column justify-content-center" method="POST">
		    	<input type="hidden" name="evento" id="evento" value="nova_senha">
		        <h3 class="title">Nova senha por E-mail</h3><br> 
		        <div class="row">

		        	<div class="col-lg-12 col-md-12" id="divAviso" style="visibility:hidden">
		        		<center>
		        			<span style="color: #f00;">Aguarde 4 minutos para enviar outro E-mail</span><br>
		        		</center>
		        	</div> 

		        	 <div class="col-lg-12 col-md-12">
		                <label for="ds_login">Usu&aacute;rio</label>
		                <div class="input-group">
		                    <input alt="Insira seu usu&aacute;rio" title="Insira seu usu&aacute;rio" type="text" class="form-control" id="ds_login" name="ds_login" placeholder="Usu&aacute;rio" required="true"/>                                 
		                </div>
		            </div>

		            <div class="col-lg-12 col-md-12">
		                <br><label for="ds_email">Email cadastrado</label>
		                <div class="input-group">
		                    <input alt="Insira seu e-mail" title="Insira seu E-mail" type="text" class="form-control" id="ds_email" name="ds_email" placeholder="E-mail" required="true"/>                                    
		                </div>
		            </div>
		        </div> 
		        <div class="col-lg-12 col-md-12">
		        	<center><br>

		        		<!-- tem q ter tempo de espera para reenviar outro email -->
		            	<button id="envia_email" class="btn btn-success" type="submit" >Enviar email</button>
		            	<a href="/trabalho-uniasselvi/" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
		        	</center>
		        </div>
		    </form>
		    <script>
		    	
		    </script>
		</main>

		<?php
	}

	static function novoNomeUsuario() {

		?>
		
		<br><main class="card-padrao">
		    <form action="projeto.view/usuarios/usuarios_man.php" class="login d-flex align-items-center flex-column justify-content-center" method="POST">
		    	<input type="hidden" name="evento" id="evento" value="novo_nome_usuario">
		        <h3 class="title">Novo nome de usu&aacute;rio por E-mail</h3><br> 
		        <div class="row">

		        	<div class="col-lg-12 col-md-12" id="divAviso" style="visibility:hidden">
		        		<center>
		        			<span style="color: #f00;">Aguarde 4 minutos para enviar outro E-mail</span><br>
		        		</center>
		        	</div> 

		        	<div class="col-lg-12 col-md-12 mt-3">
		           	<div id="divMayus" style="visibility:hidden"><span style="color: #f00;">CAPS LOCK est&aacute; ligado!</span></div> 
		                <label for="password">Senha</label>
		                 <div class="input-button-inline">
		                    <input alt="Insira sua senha" title="Insira sua senha" type="password" class="form-control" id="ds_senha" name="ds_senha" placeholder="Senha" autocomplete="on" onkeypress="capLock(event)"  required="true"/>
		                    <input class="btn btn-primary" type="button" id="showPassword" value="Mostrar" class="button" />                             
		                </div>
		            </div>

		            <div class="col-lg-12 col-md-12">
		                <br><label for="ds_email">Email cadastrado</label>
		                <div class="input-group">
		                    <input alt="Insira seu e-mail" title="Insira seu E-mail" type="text" class="form-control" id="ds_email" name="ds_email" placeholder="E-mail" required="true"/>                                    
		                </div>
		            </div>
		        </div> 
		        <div class="col-lg-12 col-md-12">
		        	<center><br>

		        		<!-- tem q ter tempo de espera para reenviar outro email -->
		            	<button id="envia_email" class="btn btn-success" type="submit" >Enviar email</button>
		            	<a href="/trabalho-uniasselvi/" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
		        	</center>
		        </div>
		    </form>
		    <script>
		    	$(document).ready(function(){
		 
		          $('#showPassword').on('click', function() {
		             
		            var passwordField = $('#ds_senha');
		            var passwordFieldType = passwordField.attr('type');
		         
		            if(passwordFieldType == 'password') {

		                passwordField.attr('type', 'text');
		                $(this).val('Ocultar');

		            } else {

		                passwordField.attr('type', 'password');
		                $(this).val('Mostrar');
		            }
		          });
		        });

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
<?php

class LoginForm {

	static function novo() {

		?>

		<main class="card-padrao">
		    <form action="login.php" class="login d-flex align-items-center flex-column justify-content-center">
		        <h3 class="title">Bem vindo(a)!</h3><br> 
		        <div class="row">

		            <div class="col-lg-12 col-md-12">
		                <label for="ds_login">Usuário</label>
		                <div class="input-group">
		                    <input type="text" class="form-control" id="ds_login" name="ds_login" required="true" />                                    
		                </div>
		            </div>

		           <div class="col-lg-12 col-md-12 mt-3">
		                <label for="password">Senha</label>
		                 <div class="input-button-inline">
		                    <input type="password" class="form-control" id="ds_senha" name="ds_senha" required="true"/>
		                    <input class="btn btn-primary" type="button" id="showPassword" value="Mostrar" class="button" />                             
		                </div>
		            </div>

		            <div class="col-lg-12 col-md-12">
		                <br><label for="tipo_usuario">Tipo de usuário</label>
		                <select id="tipo_usuario" name="tipo_usuario" class="form-control" required="true">
		                    <option value="" selected="selected">Selecione</option>
		                    <option value="1">Administrador</option>
		                    <option value="2">Professor</option>
		                </select>
		            </div>

		        </div> 
		        <div class="col-lg-12 col-md-12">
		        	<center><br>
		            	<button class="btn btn-success" type="submit" >Entrar</button>
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
		    </script>
		</main>

		<?php
	}
}


?>
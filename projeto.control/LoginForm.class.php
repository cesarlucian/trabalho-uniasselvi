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
}


?>
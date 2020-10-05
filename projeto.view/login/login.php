<?php 

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."projeto.template". DIRECTORY_SEPARATOR ."header.php");
?>

<main class="card-padrao">
    <form class="login d-flex align-items-center flex-column justify-content-center">
        <h3 class="title">Login</h3><br> 
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <label>E-mail</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="email" name="email" />                                    
                </div>
            </div>
           <div class="col-lg-12 col-md-12 mt-3">
                <label>Senha</label>
                <div class="input-group">
                        <input type="text" class="form-control" id="password" name="password" />                                     
                    </div>
                <input type="hidden" class="form-control" id="senha" name="senha">
            </div>
        </div> 
        <div class="btn btn-success mt-3">
            Entrar
        </div>
    </form>
</main>
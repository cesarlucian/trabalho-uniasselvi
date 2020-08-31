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

}


?>
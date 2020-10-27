<?php

class TurmasForm {

    static function pesquisa(){
     
        ?>  
            <main class="card-padrao">

                <form action="../turmas/index.php" method="GET" name="pesquisa" role="form"> 
                    <h3 class="title">Turmas</h3><br>
                    <div class="row">

                        <div id="filtro_pesquisa" class="col-md-2 col-lg-2">
                            <label for="filtro_pesquisa">Filtro:</label>
                            <select id="filtro_pesquisa" name="filtro_pesquisa" class="form-control">
                                <option value="" selected="selected">Selecione</option>
                                <option value="1">Dispon&iacute;veis</option>
                                <option value="2">Ocupadas</option>
                            </select>
                        </div>

                        <div id="pesquisa_turma" class="col-md-3 col-lg-3">
                            <label for="nr_turma">Pesquisar</label>
                            <div class="input-button-inline">
                                <input type="number" name="nr_turma" id="nr_turma" placeholder="Pesquisar..." class="form-control">
                            </div>
                        </div>

                         <div id="pesquisa_turma" class="col-md-6 col-lg-6">
                            <label>&nbsp;</label>
                            <div class="input-button-inline">
                                <button type="submit" class="btn btn-primary mx-3"><i class="fa fa-search">Pesquisar</button>
                            </div>
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
            <form action="../turmas/turmas_man.php" method="POST" id="nova_turma" name="nova_turma" role="form">
                <input type="hidden" name="evento" id="evento" value="nova_turma">
                <h3 class="box-title">Cadastro de turma</h3><br>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                    </div>
                </div>

                <div class="row">
                
                    <div class="col-md-3 col-lg-3">
                        <label for="nr_turma">N&uacute;mero da turma*</label>
                        <input type="number" id="nr_turma" name="nr_turma" class="form-control" placeholder="N&uacute;mero da turma" min="100" max="10000" required="true" />
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <label>&nbsp;</label>
                        <div class="input-button-inline">
                            <button type="submit" class="btn btn-success mx-3"><i class="fa fa-search">Cadastrar</button>
                                <a href="/trabalho-uniasselvi/projeto.view/turmas/index.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                        </div>
                    </div>

                </div>
            </form>
        </main>
        <script>
           
        </script>

        <?php
    }

	static function campoSelect() {

    	$lista_turma = Turmas::listaNrTurma();

    	?>

    	<select name="cd_turma" id="cd_turma" class="form-control" required="true">
    		<option value="" selected="selected"></option>

    	<?php

    	foreach($lista_turma as $turma) {

    		?>

    		<option value="<?= $turma->cd_turma; ?>"> <?= $turma->nr_turma; ?> </option>

    	<?php

    		} 

    	?>

    	</select>

    	<?php
    }

    static function campoSelectEdita($cd_turma) {

        $turma_aluno = new Turmas();
        $turma_aluno->getObject($cd_turma);

        $lista_turma = Turmas::listaNrTurma();

        ?>

        <select name="cd_turma" id="cd_turma" class="form-control" required="true">
            <option value="<?= $turma_aluno->cd_turma; ?>" selected="selected"><?= $turma_aluno->nr_turma; ?></option>

        <?php

        foreach($lista_turma as $turma) {

            ?>

            <option value="<?= $turma->cd_turma; ?>"> <?= $turma->nr_turma; ?> </option>

        <?php

            } 

        ?>

        </select>

        <?php
    }
}


?>
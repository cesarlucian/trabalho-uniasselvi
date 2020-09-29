<?php

class TurmasForm {

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
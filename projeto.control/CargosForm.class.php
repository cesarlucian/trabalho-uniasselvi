<?php 

class CargosForm {

	static function campoSelect() {

    	$lista_cargos = Cargos::listaCargos();

    	?>

    	<select name="cd_cargo" id="cd_cargo" class="form-control" required="true">
    		<option value="" selected="selected"></option>

    	<?php

    	foreach($lista_cargos as $cargo) {

    		?>

    		<option value="<?= $cargo->cd_cargo; ?>"> <?= $cargo->ds_cargo; ?> </option>

    	<?php

    		} 

    	?>

    	</select>

    	<?php
    }

    static function campoSelectEdita($cd_usuario) {

        $lista_cargos = Cargos::listaCargos();

        $usuario = new Usuarios();
        $usuario->getObject($cd_usuario);

        $cargo_usuario = new Cargos();
        $cargo_usuario->getObject($usuario->cd_cargo);

        ?>

        <select name="cd_cargo" id="cd_cargo" class="form-control" required="true">
            <option value="<?= $cargo_usuario->cd_cargo; ?>" selected="selected"><?= $cargo_usuario->ds_cargo; ?></option>

        <?php

        foreach($lista_cargos as $cargo) {

            ?>

            <option value="<?= $cargo->cd_cargo; ?>"> <?= $cargo->ds_cargo; ?> </option>

        <?php

            } 

        ?>

        </select>

        <?php
    }
}

?>
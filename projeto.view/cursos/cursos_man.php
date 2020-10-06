<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){
        
        case 'novo_curso':

        	$curso = new Cursos();
        	$curso->ds_curso = $ds_curso;
            $curso->fg_status = "A";
        
           if($curso->insert()) {

        		$msg_tipo = 1;
                $msg_texto = "Curso cadastrado com sucesso!";
                header("location: edicao.php?cd_curso=".$curso->cd_curso."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

        		$file = fopen("../../projeto.log/log.txt","a+");
        		fwrite($file,"Foi inserido um novo curso na base de dados - ".date("Y-m-d H:i:s")."\r\n");

        	} else {

        		?>
                    <script>
                        alert("Erro ao cadastrar curso!");
                        history.back();
                    </script>
                <?php

        		$file = fopen("../../projeto.log/log.txt","a+");
        		fwrite($file,"Erro ao cadastrar curso na base de dados - ".date("Y-m-d H:i:s")."\r\n");

        	}

        break;

        case 'edita_curso':

        	$curso = new Cursos();
        	$curso->getObject($cd_curso);

            $curso->ds_curso = $ds_curso;
            $curso->fg_status = "A";

        	if($curso->update()) {

	        		$msg_tipo = 1;
	                $msg_texto = "Curso atualizado com sucesso!";
	                header("location: edicao.php?cd_curso=".$cd_curso."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

	        		$file = fopen("../../projeto.log/log.txt","a+");
	        		fwrite($file,"O curso id '$cd_curso' foi atualizado na base de dados - ".date("Y-m-d H:i:s")."\r\n");

	        	} else {

	        		?>
                        <script>
                            alert("Erro ao atualizar curso!");
                            history.back();
                        </script>
                    <?php

	        		$file = fopen("../../projeto.log/log.txt","a+");
	        		fwrite($file,"Erro ao editar curso na base de dados - ".date("Y-m-d H:i:s")."\r\n");

	        	}

        break;

        case 'excluir':

            if(Cursos::delete($cd_curso)) {

                    $msg_tipo = 1;
                    $msg_texto = "Curso removido com sucesso!";
                    header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                    $file = fopen("../../projeto.log/log.txt","a+");
                    fwrite($file,"O curso id '$cd_curso' foi removido da base de dados - ".date("Y-m-d H:i:s")."\r\n");

                } else {

                    ?>
                        <script>
                            alert("Erro ao remover curso!");
                            history.back();
                        </script>
                    <?php

                    $file = fopen("../../projeto.log/log.txt","a+");
                    fwrite($file,"Erro ao remover curso da base de dados - ".date("Y-m-d H:i:s")."\r\n");

                }
        break;
    }
}



?>
<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){

        case 'nova_turma':

            $turma = new Turmas();
        	$turma->nr_turma = $nr_turma;
        
           if($turma->insert()) {

        		$msg_tipo = 1;
                $msg_texto = "Turma cadastrada com sucesso!";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

        		$file = fopen("../../projeto.log/log.txt","a+");
        		fwrite($file,"Foi inserida uma nova turma na base de dados - ".date("Y-m-d H:i:s")."\r\n");

        	} else {

        		?>
                    <script>
                        alert("Erro ao cadastrar turma!");
                        history.back();
                    </script>
                <?php

        		$file = fopen("../../projeto.log/log.txt","a+");
        		fwrite($file,"Erro ao cadastrar turma na base de dados - ".date("Y-m-d H:i:s")."\r\n");

        	}

        break;
        
        case 'excluir':

            if(Turmas::delete($cd_turma)) {

                $msg_tipo = 1;
                $msg_texto = "Turma removida com sucesso!";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"A turma id '$cd_turma' foi removida da base de dados - ".date("Y-m-d H:i:s")."\r\n");

            } else {

                ?>
                    <script>
                        alert("Erro ao excluir turma!");
                        history.back();
                    </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Erro ao excluir turma da base de dados - ".date("Y-m-d H:i:s")."\r\n");

            }

        break;

        case 'tornar_disponivel':

            if(Turmas::tornarDisponivel($cd_turma)) {

                Alunos::removerTurma($cd_turma);

                $msg_tipo = 1;
                $msg_texto = "Turma alterada com sucesso!";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"A turma id '$cd_turma' teve seu curso desvinculado na base de dados - ".date("Y-m-d H:i:s")."\r\n");

            } else {

                ?>
                    <script>
                        alert("Erro ao alterar turma!");
                        history.back();
                    </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Erro ao alterar turma na base de dados - ".date("Y-m-d H:i:s")."\r\n");

            }

        break;

        case 'vincular_curso':

           if(Turmas::vincularCurso($cd_turma,$cd_curso)) {

                 ?>
                    <script>
                        alert("Curso vinculado a esta turma com sucesso!");
                        window.close();
                    </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"O curso id '$cd_curso' foi vinculado a turma id '$cd_turma' na base de dados - ".date("Y-m-d H:i:s")."\r\n");

            } else {

                ?>
                    <script>
                        alert("Erro ao vincular curso a esta turma!");
                        history.back();
                    </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Erro ao vincular curso id '$cd_curso' a turma id '$cd_turma' na base de dados - ".date("Y-m-d H:i:s")."\r\n");

            }
        break;
    }
}



?>
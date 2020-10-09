<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){

        case 'lista_chamada':

            $aluno_situacao = array();

            array_push($aluno_situacao, array(
                "sit_chamada" =>$sit_chamada,
                "cd_aluno"    =>$cd_aluno,
                "cd_turma"    =>$cd_turma
            ));

            $i = 0;

            if(!empty($cd_aluno)) {

                foreach($aluno_situacao as $data) {

                    for($i = 0; $i < count($sit_chamada); $i++) {

                        Chamada::realizaChamada($data['cd_aluno'][$i],$data['sit_chamada'][$i],$data['cd_turma'][$i]);

                    }  
                }

                $msg_tipo = 1;
                $msg_texto = "Chamada realizada com sucesso!";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Chamada realizada com sucesso - ".date("Y-m-d H:i:s")."\r\n");

            } else {

                ?>
                    <script>
                        alert("Erro ao realizar chamada!");
                        history.back();
                    </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Erro ao realizar chamada - ".date("Y-m-d H:i:s")."\r\n");

            } 

        break;
    }
}

?>
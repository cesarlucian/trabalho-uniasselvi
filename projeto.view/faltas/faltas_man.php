<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);
include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){

        case 'nova_falta':

        // metodo local de upload

        $aluno = new Alunos();
        $aluno->getObject($cd_aluno);

        $faltas = new FaltasJustificadas();
        $chamada = new Chamada();

        $file = $_FILES["nm_arquivo"];

        $pasta_destino = "../../projeto.arquivos";
        $arquivo_ext = explode(".",$file["name"]);
        $ext = $arquivo_ext[1];

        // ------------------------

        /* metodo servidor upload 
        
        $upload = new Upload;
        $upload->efetuaUpload('trabalho-uniasselvi/projeto.arquivos/'.$file, $file['tmp_name']);

        */

        if($file["size"] > "30000") {

            ?>
                <script>
                    alert("Erro ao registrar falta, arquivo muito grande! M\u00e1ximo 30kb");
                    history.back();
                </script>
            <?php

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro ao registrar falta, arquivo muito grande, máximo 30kb - ".date("Y-m-d H:i:s")."\r\n");

        } else {

            if($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'jpeg' || $ext =='jpg' || $ext == 'png') {

                if($chamada->verificaFalta($cd_aluno, $dt_falta)) {

                    $nome_arquivo = $aluno->nr_matricula.".".$ext;

                    move_uploaded_file($file["tmp_name"], $pasta_destino . "/". $nome_arquivo);

                    $faltas->adicionaFaltaJustificada($cd_aluno,$dt_falta,$ds_motivo,$nome_arquivo);

                    $msg_tipo = 1;
                    $msg_texto = "Falta registrada com sucesso!";
                    header("location: consulta_faltas.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                    $file = fopen("../../projeto.log/log.txt","a+");
                    fwrite($file,"Falta justificada registrada com sucesso - ".date("Y-m-d H:i:s")."\r\n");

                } else {

                    ?>
                        <script>
                            alert("Erro ao registrar falta, nenhuma falta encontrada nesta data!");
                            history.back();
                        </script>
                    <?php

                    $file = fopen("../../projeto.log/log.txt","a+");
                    fwrite($file,"Erro ao registrar falta justificada, falta nao encontrada - ".date("Y-m-d H:i:s")."\r\n");
                }

            } else {

                ?>
                    <script>
                        alert("Erro ao registrar falta, tipo de arquivo inv\u00e1lido!");
                        history.back();
                    </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Erro ao registrar falta, arquivo com extensão não permitida - ".date("Y-m-d H:i:s")."\r\n");
            }

        } 

        break;

        case 'aceitar_falta':
            
            $chamada = new Chamada();
            $faltas = new FaltasJustificadas();

            //print $dt_falta."   ".$cd_aluno." ".$cd_falta;

            //exit;

            if($chamada->removeFalta($dt_falta,$cd_aluno)) {

                $faltas->delete($cd_falta);

                $msg_tipo = 1;
                $msg_texto = utf8_encode("Falta aceita com sucesso! Presença inserida para o aluno.");
                header("location: consulta_faltas.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Falta justificada aceita com sucesso - ".date("Y-m-d H:i:s")."\r\n");


            } else {

                ?>
                    <script>
                        alert("Erro ao aceitar falta, tente novamente!");
                        history.back();
                    </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Erro ao aceitar falta - ".date("Y-m-d H:i:s")."\r\n");
            }


        break;


        case 'recusar_falta':

            $faltas = new FaltasJustificadas();

            if($faltas->delete($cd_falta)) {

                $msg_tipo = 1;
                $msg_texto = utf8_encode("Falta recusada com sucesso! Falta mantida para o aluno.");
                header("location: consulta_faltas.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Falta justificada recusada com sucesso - ".date("Y-m-d H:i:s")."\r\n");


            } else {

                ?>
                    <script>
                        alert("Erro ao recusar falta, tente novamente!");
                        history.back();
                    </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Erro ao recusar falta - ".date("Y-m-d H:i:s")."\r\n");
            }
        break;
    }
}



?>
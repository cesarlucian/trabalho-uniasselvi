<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){

        case 'nova_falta':

        // metodo local de upload

        $file = $_FILES["nm_arquivo"];

        $pasta_destino = "../../projeto.arquivos";
        $extensoes_permitidas = array('pdf', 'doc', 'docx','jpeg', 'jpg', 'png');
        $arquivo_ext = explode(".",$file["name"]);
        $ext = $arquivo_ext[1];

        // ------------------------

        // metodo servidor upload 
        // ----------------------

        if($file["size"] > "30000") {

            $msg_tipo = 2;
            $msg_texto = "Erro ao registrar falta, arquivo muito grande! Máximo 30kb";
            header("location: registra_falta.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro ao registrar falta, arquivo muito grande, máximo 30kb - ".date("Y-m-d H:i:s")."\r\n");

        } else {

            if($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'jpeg' || $ext =='jpg' || $ext == 'png') {

                if(Chamada::verificaFalta($cd_aluno, $dt_falta)) {

                    move_uploaded_file($file["tmp_name"], $pasta_destino . DIRECTORY_SEPARATOR . $file["name"]);

                    FaltasJustificadas::adicionaFaltaJustificada($cd_aluno,$dt_falta,$ds_motivo,$nm_arquivo);

                    $msg_tipo = 1;
                    $msg_texto = "Falta registrada com sucesso!";
                    header("location: registra_falta.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                    $file = fopen("../../projeto.log/log.txt","a+");
                    fwrite($file,"Falta justificada registrada com sucesso - ".date("Y-m-d H:i:s")."\r\n");

                } else {

                    $msg_tipo = 2;
                    $msg_texto = "Erro ao registrar falta, nenhuma falta encontrada nesta data!";
                    header("location: registra_falta.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                    $file = fopen("../../projeto.log/log.txt","a+");
                    fwrite($file,"Erro ao registrar falta justificada, falta nao encontrada - ".date("Y-m-d H:i:s")."\r\n");
                }

            } else {

                $msg_tipo = 2;
                $msg_texto = "Erro ao registrar falta, tipo de arquivo inválido!";
                header("location: registra_falta.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Erro ao registrar falta, arquivo com extensão não permitida - ".date("Y-m-d H:i:s")."\r\n");
            }

        } 

        break;

        case 'aceitar_falta':
            echo "aceitar";
        break;


        case 'recusar_falta':
            echo "recusar";
        break;
    }
}



?>
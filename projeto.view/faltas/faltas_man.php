<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);
include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){

        case 'nova_falta':

        $aluno = new Alunos();
        $aluno->getObject($cd_aluno);

        $faltas = new FaltasJustificadas();
        $chamada = new Chamada();

        $extensoes_permitidas = array('jpeg', 'jpg', 'png','pdf', 'doc', 'docx');

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

        } else if(!in_array($ext, $extensoes_permitidas)) {

            ?>
                <script>
                    alert("Erro ao registrar falta, tipo de arquivo inv\u00e1lido!");
                    history.back();
                </script>
            <?php

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro ao registrar falta, arquivo com extensão não permitida - ".date("Y-m-d H:i:s")."\r\n");


        } else {

            $chamada->removeFalta($dt_falta,$cd_aluno);

            $nome_arquivo = $aluno->nr_matricula."_".$dt_falta.".".$ext;

            move_uploaded_file($file["tmp_name"], $pasta_destino . "/". $nome_arquivo);

            $faltas->adicionaFaltaJustificada($cd_aluno,$dt_falta,$ds_motivo,$nome_arquivo);

            ?>
                <script>
                    alert("Falta justificada registrada com sucesso ! Foi removida a falta do aluno.");
                    window.close();
                </script>
            <?php

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Falta justificada registrada com sucesso - ".date("Y-m-d H:i:s")."\r\n");
            
        }

        break;
    }
}



?>
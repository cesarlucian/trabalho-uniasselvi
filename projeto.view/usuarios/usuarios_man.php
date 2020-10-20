<?php

include_once("..". DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR ."config.php");

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){

        case 'novo_usuario':
            $usuario = new Usuarios();

            $usuario->fg_status = "A";
            $usuario->nm_usuario = $nm_usuario;
            $usuario->ds_login = $ds_login;
            $usuario->ds_email = $ds_email;
            $usuario->cd_cargo =  $cd_cargo;

            // Senha padrão

            $quebra_nome = explode(" ", $usuario->nm_usuario);
            $nome_padrao_login = Geral::removeAcentos($quebra_nome[0]);                    
            $ds_senha = "@".trim(strtolower($nome_padrao_login))."123";

            $usuario->ds_senha = password_hash(strtolower($ds_senha), PASSWORD_DEFAULT);
        
           if($usuario->insert()) {

                $msg_tipo = 1;
                $msg_texto = utf8_encode("Usuário cadastrado com sucesso!");
                header("location: edicao.php?cd_usuario=".$usuario->cd_usuario."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Foi inserido um novo usuario na base de dados - ".date("Y-m-d H:i:s")."\r\n");

            } else {

                ?>
                    <script>
                        alert("Erro ao cadastrar usu\u00e1rio!");
                        history.back();
                    </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Erro ao cadastrar usuario na base de dados - ".date("Y-m-d H:i:s")."\r\n");
            }
        break;

        case 'edita_usuario':

            $usuario = new Usuarios();
            $usuario->getObject($cd_usuario);

            $usuario->fg_status = $fg_status;
            $usuario->nm_usuario = $nm_usuario;
            $usuario->ds_login = $ds_login;
            $usuario->ds_email = $ds_email;
            $usuario->cd_cargo =  $cd_cargo;

            if($check_box) {

                // Senha padrão

                $email = new Email();

                $quebra_nome = explode(" ", $usuario->nm_usuario);
                $nome_padrao_login = Geral::removeAcentos($quebra_nome[0]);                    
                $ds_senha = "@".trim(strtolower($nome_padrao_login))."123";

                $usuario->ds_senha = password_hash(strtolower($ds_senha), PASSWORD_DEFAULT);
            }

           if($usuario->update()) {

                $msg_tipo = 1;
                $msg_texto = utf8_encode("Usuário atualizado com sucesso!");
                header("location: edicao.php?cd_usuario=".$usuario->cd_usuario."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"O usuario id '$cd_usuario' foi atualizado na base de dados - ".date("Y-m-d H:i:s")."\r\n");

            } else {

                ?>
                    <script>
                        alert("Erro ao atualizar usu\u00e1rio!");
                        history.back();
                    </script>
                <?php

                $file = fopen("../../projeto.log/log.txt","a+");
                fwrite($file,"Erro ao atualizar usuario na base de dados - ".date("Y-m-d H:i:s")."\r\n");
            }
        break;
    }
}



?>
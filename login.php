<?php

include_once("config.php");

extract($_POST);
extract($_GET);

$usuario  = $ds_login;
$senha    = $ds_senha;

try{

    TTransaction::open("projeto01");

    $sql = "SELECT cd_usuario, ds_senha "
            . "FROM usuarios "
            . "WHERE ds_login = :ds_login and fg_status = 'A'";

    $conn = TTransaction::get();
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':ds_login', $ds_login);

    $stmt->execute();    

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    unset($conn);
    TTransaction::close();
    
        if($data['cd_usuario']){


            $usuario = new Usuarios();
            $usuario->getObject($data['cd_usuario']);

            $nome_usuario = Geral::removeAcentos($usuario->nm_usuario);
            $quebra_nome = explode(" ",strtolower($nome_usuario));
            $primeiro_nome = $quebra_nome[0];

            $senha_padrao = "@".$primeiro_nome."123";

            if(password_verify($ds_senha, $data['ds_senha'])) {

                if($ds_senha === $senha_padrao) {

                    header("location: nova_senha.php?cd_usuario=".$data['cd_usuario']);

                } else {

                    new TSession;

                    TSession::setValue('usuario', $usuario);

                    TTransaction::open("projeto01");

                    $sql = "
                    INSERT INTO login_details 
                    (cd_usuario) 
                    VALUES ('".$data['cd_usuario']."')
                    ";

                    $conn = TTransaction::get();
                    $result = $conn->query($sql);

                    TSession::setValue('cd_login_detalhe', $conn->lastInsertId());

                    TTransaction::close();

                    header("location: inicial.php");
                }

            } else {
                echo "<script>alert('Senha informada incorreta!');history.back();</script>";
            }
        
        } else{
            echo "<script>alert('Usu\u00e1rio n\u00e3o encontrado!');history.back();</script>";
        } 

    } catch (Exception $ex) {
        //echo $ex->getMessage();
        $file = fopen("projeto.log/log.txt","a+");
        fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
        fclose($file);
    }




?>
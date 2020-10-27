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
    
        if($data['cd_usuario']){


            $usuario = new Usuarios();
            $usuario->getObject($data['cd_usuario']);

            $nome_usuario = Geral::removeAcentos($usuario->nm_usuario);
            $quebra_nome = explode(" ",strtolower($nome_usuario));
            $primeiro_nome = $quebra_nome[0];

            $senha_padrao = "@".$primeiro_nome."123";

            if(password_verify($senha_padrao, $data['ds_senha'])) {

                header("location: nova_senha.php?cd_usuario=".$data['cd_usuario']);

            } else if(password_verify($ds_senha, $data['ds_senha'])) {

                session_set_cookie_params(900);
                
                new TSession;

                TSession::setValue('usuario', $usuario);

                header("location: inicial.php");

            } else {
                echo "<script>alert('Senha informada incorreta!');history.back();</script>";
            }
        
        } else{
            echo "<script>alert('Usu\u00e1rio n\u00e3o encontrado!');history.back();</script>";
        } 

    } catch (Exception $ex) {
        $ex->getMessage();
        exit;
    }




?>
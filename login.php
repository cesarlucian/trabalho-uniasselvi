<?php

include_once("config.php");

extract($_POST);
extract($_GET);

$login = new Usuarios();

$usuario    = $ds_login;
$$senha     = $ds_senha;
$tp_usuario = $tipo_usuario;

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

        	if(password_verify($ds_senha, $data['ds_senha'])) {

                new TSession;

        		$login->getObject($data['cd_usuario']);

        		TSession::setValue('cd_usuario', $login->cd_usuario);
        		TSession::setValue('tipo_usuario', $login->tipo_usuario);
	            TSession::setValue('usuario', $usuario);

                header("location: inicial.php");


        	} else {
        		echo "Senha incorreta!";
	        	echo "<script>alert('Senha incorreta!');history.back();</script>";
        	}
        
        } else{

	        echo "Usuário não encontrado!";
	        echo "<script>alert('Usuario nao encontrado!');history.back();</script>";
	        //header("location: index.php");
    	} 

    } catch (Exception $ex) {
        print_r($ex);
        exit;
    }




?>
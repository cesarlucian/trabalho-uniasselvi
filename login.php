<?php

include_once("config.php");

extract($_POST);
extract($_GET);

$login = new Usuarios();

$usuario    = $ds_login;
$senha      = $ds_senha;

try{

    TTransaction::open("projeto01");

    $sql = "SELECT cd_usuario, tipo_usuario, ds_senha "
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

                session_set_cookie_params(900);
                new TSession;

        		$login->getObject($data['cd_usuario']);

        		TSession::setValue('cd_usuario', $login->cd_usuario);
        		TSession::setValue('tipo_usuario', $data['tipo_usuario']);
	            TSession::setValue('usuario', $usuario);

                header("location: inicial.php");


        	} else {
        		echo "Senha incorreta!";
	        	echo "<script>alert('Senha incorreta!');history.back();</script>";
        	}
        
        } else{

	        echo "Usuário não encontrado!";
	        echo "<script>alert('Usu\u00e1rio n\u00e3o encontrado!');history.back();</script>";
	        //header("location: index.php");
    	} 

    } catch (Exception $ex) {
        $ex->getMessage();
        exit;
    }




?>
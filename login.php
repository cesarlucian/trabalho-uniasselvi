<?php

include_once("config.php");

extract($_POST);
extract($_GET);

new Usuarios();

$usuario    = $ds_login;
$$senha     = $ds_senha;
$tp_usuario = $tipo_usuario;

try{

    TTransaction::open("my_gestor02");

    $sql = "SELECT cd_usuario, ds_senha "
            . "FROM usuarios "
            . "WHERE ds_login = '$ds_login' and tipo_usuario = '$tipo_usuario' and fg_status = 'A'";

    //print($sql);exit;

    $conn = TTransaction::get();
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    unset($conn);
    
        if($data['cd_usuario']){

        	if(password_verify($ds_senha, $data['ds_senha'])) {

        		new TSession;

	            $file = fopen("../../projeto.log/log.txt","a+");
	            fwrite($file,"Usuario login: '$usuario' acessou o sistema - ".date("Y-m-d H:i:s")."\r\n");

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
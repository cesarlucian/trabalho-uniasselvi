<?php

class LoginDetalhes {

	public $cd_login_detalhe;
	public $cd_usuario;
	public $ultima_atividade;
	public $digitando;

	const TABLE = "login_details";
	const ID = "cd_login_detalhes";
	const DIRETORIO = "projeto.view";

	static public function atualizarAtividade() {

		try {

			TTransaction::open();

			$sql = "
					UPDATE login_details 
					SET ultima_atividade = now() 
					WHERE cd_login_detalhe = '".$_SESSION["cd_login_detalhe"]."'
					";		

			$conn = TTransaction::get();
			$result = $conn->query($sql);

			TTransaction::close();

		} catch(Exception $ex) {

			echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            fclose($file);
            TTransaction::rollback();      
            return false;
		}
	}

	static public function buscarUltimaAtividade($cd_usuario) {

        $ultima_atividade = null;

		try {

			TTransaction::open();

			$sql = "
					SELECT * FROM login_details 
					WHERE cd_usuario = '$cd_usuario' 
					ORDER BY ultima_atividade DESC 
					LIMIT 1
					";		

			$conn = TTransaction::get();
			$result = $conn->query($sql);
			unset($conn);

			foreach($result as $data) {
				$ultima_atividade = $data['ultima_atividade'];
			}

			return $ultima_atividade;
			

		} catch(Exception $ex) {

			echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            fclose($file);
		}

	}

	static public function verificaSeEstaDigitando($cd_usuario) {

		try {

			TTransaction::open();

			$sql = "SELECT digitando FROM login_details 
					WHERE cd_usuario = '".$cd_usuario."' 
					ORDER BY ultima_atividade DESC 
					LIMIT 1
					";		

			$conn = TTransaction::get();
			$result = $conn->query($sql);
			unset($conn);

            $output = '';

			foreach($result as $data) {

				if($data["digitando"] == "yes")
				{
					$output = ' - <small><em><span class="text-muted">Digitando...</span></em></small>';
				}
			}
			
			return $output;
			
		} catch(Exception $ex) {

			echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            fclose($file);
		}
	}

	static public function atualizarStatusDigitando($digitando) {

		try {

			TTransaction::open();

			$sql = "
			UPDATE login_details 
			SET digitando = '".$digitando."' 
			WHERE cd_login_detalhe = '".$_SESSION["cd_login_detalhe"]."'
			";

			$conn = TTransaction::get();
			$result = $conn->query($sql);

			TTransaction::close();

		} catch(Exception $ex) {

			echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            fclose($file);
            TTransaction::rollback();      
            return false;
		}
	}
}



?>
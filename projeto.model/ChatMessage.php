<?php

class ChatMessage {

	public $cd_mensagem;
	public $cd_destinatario;
	public $cd_remetente;
	public $chat_mensagem;
	public $dt_mensagem;
	public $status;

	const TABLE = "chat_message";
	const ID = "cd_mensagem";
	const DIRETORIO = "projeto.view";


	static public function mensagensNaoVistas($cd_remetente, $cd_destinatario) {

		try {

			TTransaction::open();

			$sql = "
				SELECT * FROM chat_message 
				WHERE cd_remetente = '$cd_remetente' 
				AND cd_destinatario = '$cd_destinatario' 
				AND status = '1'
				";		

			$conn = TTransaction::get();
			$result = $conn->query($sql);

			$count = null;
			unset($conn);

			foreach($result as $data) {
				$count++;
			}

			$output = '';

			if($count > 0)
			{
				$output = '
                <audio src="/trabalho-uniasselvi/projeto.sound/notificacao.mp3" id="blip"></audio>
                <script src="/trabalho-uniasselvi/js/scripts.js"></script>
                <script>
                	play();
                </script>
				<span class="label label-success">'.$count.'</span>';
			}
			return $output;
		
			TTransaction::close();

		} catch(Exception $ex) {

			echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            fclose($file);
		}

	}

	static public function inserirMensagem($cd_destinatario,$cd_remetente,$chat_mensagem,$status) {

		try{

            TTransaction::open();

            $data = array(
				'cd_destinatario'   =>	$_POST['to_user_id'],
				'cd_remetente'		=>	$_SESSION["usuario"]->cd_usuario,
				'chat_mensagem'		=>	$_POST['chat_message'],
				'status'			=>	'1'
			);

            $sql = "INSERT INTO chat_message 
					(cd_destinatario, cd_remetente, chat_mensagem, status) 
					VALUES (".$data["cd_destinatario"].",".$data["cd_remetente"].",'".$data["chat_mensagem"]."',".$data["status"].")
					";

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            TTransaction::close();
            
            return true;
            
        } catch (Exception $ex) {   
            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            fclose($file);
            TTransaction::rollback();      
            return false;
        }
	}

	static public function inserirMensagemGrupo() {

		try {

			TTransaction::open();

			$data = array(
				'cd_remetente'		=>	$_SESSION["usuario"]->cd_usuario,
				'chat_mensagem'		=>	$_POST['chat_message'],
				'status'			=>	'1'
			);

			$sql = "
			INSERT INTO chat_message 
			(cd_remetente, chat_mensagem, status) 
			VALUES (".$data["cd_remetente"].", '".$data["chat_mensagem"]."', ".$data["status"].")
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

	static public function removerMensagem() {

		try {

			TTransaction::open();

			$sql = "
					UPDATE chat_message 
					SET status = '2' 
					WHERE cd_mensagem = '".$_POST["chat_message_id"]."'
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

	static public function buscarHistoricoChatEmGrupo() {

		try {

			TTransaction::open();

			$sql = "
					SELECT * FROM chat_message 
					WHERE cd_destinatario = '0' AND DATE_FORMAT(dt_mensagem,'%Y-%m-%d') = '".date("Y-m-d")."'
					ORDER BY dt_mensagem DESC
					";	

			$conn = TTransaction::get();
			$result = $conn->query($sql);

			unset($conn);

			$output = '<ul class="list-unstyled">';

			foreach($result as $data) {

				$user_name = '';
				$dynamic_background = '';
				$chat_message = '';
				if($data["cd_remetente"] == $_SESSION["usuario"]->cd_usuario)
				{
					if($data["status"] == '2')
					{
						$chat_message = '<em>Mensagem removida</em>';
						$user_name = '<b class="text-success">Voc&ecirc;</b>';
					}
					else
					{
						$chat_message = $data["chat_mensagem"];
						$user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$data['cd_mensagem'].'">x</button>&nbsp;<b class="text-success">Voc&ecirc;</b>';
					}
					
					$dynamic_background = 'background-color:#ffe6e6;';
				}
				else
				{
					if($data["status"] == '2')
					{
						$chat_message = '<em>Mensagem removida</em>';
					}
					else
					{
						$chat_message = $data["chat_mensagem"];
					}
					$user_name = '<b class="text-danger">'.Usuarios::getPrimeiroNome($data['cd_remetente']).'</b>';
					$dynamic_background = 'background-color:#ffffe6;';
				}

				$output .= '

				<hr>
					<p>'.$user_name.': '.$chat_message.' 
						<div align="right">
							<small><em>'.$data['dt_mensagem'].'</em></small>
						</div>
					</p>
				<hr>
				';
			}

			$output .= '</ul>';
			echo $output;
		
		} catch(Exception $ex) {

			echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            fclose($file);
		}
	}

	static public function buscarHistoricoChatUsuario($cd_remetente,$cd_destinatario) {

		try {

			TTransaction::open();

			$sql = "
					SELECT * FROM chat_message 
					WHERE (cd_remetente = '".$cd_remetente."' 
					AND cd_destinatario = '".$cd_destinatario."' AND DATE_FORMAT(dt_mensagem,'%Y-%m-%d') = '".date("Y-m-d")."') 
					OR (cd_remetente = '".$cd_destinatario."' 
					AND cd_destinatario = '".$cd_remetente."' AND DATE_FORMAT(dt_mensagem,'%Y-%m-%d') = '".date("Y-m-d")."') 
					ORDER BY dt_mensagem DESC
					";	

			$conn = TTransaction::get();
			$result = $conn->query($sql);

			$output = '<ul class="list-unstyled">';

			foreach($result as $data) {

				$user_name = '';
				$dynamic_background = '';
				$chat_message = '';
				if($data["cd_remetente"] == $cd_remetente)
				{
					if($data["status"] == '2')
					{
						$chat_message = '<em>Mensagem removida</em>';
						$user_name = '<b class="text-success">Voc&ecirc;</b>';
					}
					else
					{
						$chat_message = $data["chat_mensagem"];
						$user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$data['cd_mensagem'].'">x</button>&nbsp;<b class="text-success">Voc&ecirc;</b>';
					}
					

					$dynamic_background = 'background-color:#ffe6e6;';
				}
				else
				{
					if($data["status"] == '2')
					{
						$chat_message = '<em>Mensagem removida</em>';
					}
					else
					{
						$chat_message = $data["chat_mensagem"];
					}
					$user_name = '<b class="text-danger">'.Usuarios::getPrimeiroNome($data['cd_remetente']).'</b>';
					$dynamic_background = 'background-color:#ffffe6;';
				}
				$output .= '
				<hr>
					<p>'.$user_name.': '.$chat_message.'
						<div align="right">
							<small><em>'.$data['dt_mensagem'].'</em></small>
						</div>
					</p>
				<hr>
				';
			}

			$output .= '</ul>';

			$sql = "
			UPDATE chat_message 
			SET status = '0' 
			WHERE cd_remetente = '".$cd_destinatario."' 
			AND cd_destinatario = '".$cd_remetente."' 
			AND status = '1'
			";

			$conn = TTransaction::get();
			$result = $conn->query($sql);

			TTransaction::close();
			echo $output;
			

		} catch(Exception $ex) {

			echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            fclose($file);
		}
	}
}


?>
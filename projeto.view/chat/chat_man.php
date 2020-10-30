<?php

include_once("../../config.php");

new TSession;

extract($_POST);
extract($_GET);
extract($_FILES);

if(isset($evento)) {
	switch($evento) {

		case 'buscar_usuario':
			Usuarios::getUsuarioChat(); 
		break;

		case 'atualizar_atividade':
			LoginDetalhes::atualizarAtividade();
		break;

		case 'inserir_mensagem':
			ChatMessage::inserirMensagem($_POST["to_user_id"],$_SESSION["usuario"]->cd_usuario,$_POST["chat_message"],'1');
		break;

		case 'buscar_historico_chat_usuario':
			ChatMessage::buscarHistoricoChatUsuario($_SESSION["usuario"]->cd_usuario, $_POST["to_user_id"]);
		break;

		case 'atualizar_status_digitando':
			LoginDetalhes::atualizarStatusDigitando($_POST["is_type"]);
		break;

		case 'chat_em_grupo':

			if($_POST["action"] == "insert_data") {
				ChatMessage::inserirMensagemGrupo($_SESSION["usuario"]->cd_usuario,$_POST["chat_message"],'1');
			}

			if($_POST["action"] == "fetch_data") {
				ChatMessage::buscarHistoricoChatEmGrupo();
			}
			
		break;

		case 'remover_chat':
			ChatMessage::removerChat();
		break;

		/*case 'upload_arquivo_chat':

			if(!empty($_FILES))
				{
					if(is_uploaded_file($_FILES['uploadFile']['tmp_name']))
					{
						$ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
						$allow_ext = array('jpg', 'png');
						if(in_array($ext, $allow_ext))
						{
							$_source_path = $_FILES['uploadFile']['tmp_name'];
							$target_path = '/trabalho-uniasselvi/projeto.arquivos/chat/' . $_FILES['uploadFile']['name'];
							if(move_uploaded_file($_source_path, $target_path))
							{
								echo '<p><img src="'.$target_path.'" class="img-thumbnail" width="200" height="160" /></p><br />';
							}
							//echo $ext;
						}
					}
				}
		break;*/

	}
}



?>
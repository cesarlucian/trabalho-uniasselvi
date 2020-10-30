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
			ChatMessage::inserirMensagemGrupo();
		break;

		case 'buscar_historico_chat_em_grupo':
			ChatMessage::buscarHistoricoChatEmGrupo();
		break;

		case 'remover_chat':
			ChatMessage::removerMensagem();
		break;

		case 'upload_arquivo_chat':

			if(!empty($_FILES)) { 

				$file = $_FILES["uploadFile"];
	            $pasta_destino = "../../projeto.arquivos/chat";
	            $arquivo_ext = explode(".",$file["name"]);
	            $ext = $arquivo_ext[1];

	            $local_arquivo = "/trabalho-uniasselvi/projeto.arquivos/chat/".$file["name"];

	            // ------------------------

	            /* metodo servidor upload 
	            
	            $upload = new Upload;
	            $upload->efetuaUpload('trabalho-uniasselvi/projeto.arquivos/chat/'.$file, $file['tmp_name']);

	            */

	            $nome_arquivo = $file["name"];

	            if(move_uploaded_file($file["tmp_name"], $pasta_destino . "/". $nome_arquivo)) {
	            	echo '<p><img src="'.$local_arquivo.'" class="img-thumbnail" width="200" height="160" /></p><br />';
	            }

        	}
		break;

	}
}



?>
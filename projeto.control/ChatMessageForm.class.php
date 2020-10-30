<?php

class ChatMessageForm {

	static public function chatEmGrupo() {
		?>
		<div id="group_chat_dialog" title="Chat em Grupo">
			<div id="group_chat_history" style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;">

			</div>
			<div class="form-group">
				<!--<textarea name="group_chat_message" id="group_chat_message" class="form-control"></textarea>!-->
				<div class="chat_message_area">
					<div id="group_chat_message" contenteditable class="form-control">

					</div>
					<div class="image_upload">
						<form id="uploadImage" method="post" action="/trabalho-uniasselvi/projeto.view/chat/chat_man.php">
							<input type="hidden" name="evento" id="evento" value="upload_arquivo_chat">
							<label for="uploadFile"><img src="upload.png" /></label>
							<input type="file" name="uploadFile" id="uploadFile" accept=".jpg, .png" />
						</form>
					</div>
				</div>
			</div>
			<div class="form-group" align="right">
				<button type="button" name="send_group_chat" id="send_group_chat" class="btn btn-info">Enviar</button>
			</div>
		</div>


		<script>  
		$(document).ready(function(){

			fetch_user();

			setInterval(function(){
				update_last_activity();
				fetch_user();
				update_chat_history_data();
				fetch_group_chat_history();
			}, 5000);

			function fetch_user()
			{
				$.ajax({
					url:"/trabalho-uniasselvi/projeto.view/chat/chat_man.php?evento=buscar_usuario",
					method:"POST",
					success:function(data){
						$('#user_details').html(data);
					}
				})
			}

			function update_last_activity()
			{
				$.ajax({
					url:"/trabalho-uniasselvi/projeto.view/chat/chat_man.php?evento=atualizar_atividade",
					success:function()
					{

					}
				})
			}

			function make_chat_dialog_box(to_user_id, to_user_name)
			{
				var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="Conversando com '+to_user_name+'">';
				modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
				modal_content += fetch_user_chat_history(to_user_id);
				modal_content += '</div>';
				modal_content += '<div class="form-group">';
				modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>';
				modal_content += '</div><div class="form-group" align="right">';
				modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Enviar</button></div></div>';
				$('#user_model_details').html(modal_content);
			}

			$(document).on('click', '.start_chat', function(){
				var to_user_id = $(this).data('touserid');
				var to_user_name = $(this).data('tousername');
				make_chat_dialog_box(to_user_id, to_user_name);
				$("#user_dialog_"+to_user_id).dialog({
					autoOpen:false,
					width:400
				});
				$('#user_dialog_'+to_user_id).dialog('open');
				$('#chat_message_'+to_user_id).emojioneArea({
					pickerPosition:"top",
					toneStyle: "bullet"
				});
			});

			$(document).on('click', '.send_chat', function(){
				var to_user_id = $(this).attr('id');
				var chat_message = $.trim($('#chat_message_'+to_user_id).val());
				if(chat_message != '')
				{
					$.ajax({
						url:"/trabalho-uniasselvi/projeto.view/chat/chat_man.php?evento=inserir_mensagem",
						method:"POST",
						data:{to_user_id:to_user_id, chat_message:chat_message},
						success:function(data)
						{
							//$('#chat_message_'+to_user_id).val('');
							var element = $('#chat_message_'+to_user_id).emojioneArea();
							element[0].emojioneArea.setText('');
							$('#chat_history_'+to_user_id).html(data);
						}
					})
				}
				else
				{
					alert('Type something');
				}
			});

			function fetch_user_chat_history(to_user_id)
			{
				$.ajax({
					url:"/trabalho-uniasselvi/projeto.view/chat/chat_man.php?evento=buscar_historico_chat_usuario",
					method:"POST",
					data:{to_user_id:to_user_id},
					success:function(data){
						$('#chat_history_'+to_user_id).html(data);
					}
				})
			}

			function update_chat_history_data()
			{
				$('.chat_history').each(function(){
					var to_user_id = $(this).data('touserid');
					fetch_user_chat_history(to_user_id);
				});
			}

			$(document).on('click', '.ui-button-icon', function(){
				$('.user_dialog').dialog('destroy').remove();
				$('#is_active_group_chat_window').val('no');
			});

			$(document).on('focus', '.chat_message', function(){
				var is_type = 'yes';
				$.ajax({
					url:"/trabalho-uniasselvi/projeto.view/chat/chat_man.php?evento=atualizar_status_digitando",
					method:"POST",
					data:{is_type:is_type},
					success:function()
					{

					}
				})
			});

			$(document).on('blur', '.chat_message', function(){
				var is_type = 'no';
				$.ajax({
					url:"/trabalho-uniasselvi/projeto.view/chat/chat_man.php?evento=atualizar_status_digitando",
					method:"POST",
					data:{is_type:is_type},
					success:function()
					{
						
					}
				})
			});

			$('#group_chat_dialog').dialog({
				autoOpen:false,
				width:400
			});

			$('#group_chat').click(function(){
				$('#group_chat_dialog').dialog('open');
				$('#is_active_group_chat_window').val('yes');
				fetch_group_chat_history();
			});

			$('#send_group_chat').click(function(){
				var chat_message = $.trim($('#group_chat_message').html());
				var action = 'insert_data';
				if(chat_message != '')
				{
					$.ajax({
						url:"/trabalho-uniasselvi/projeto.view/chat/chat_man.php?evento=chat_em_grupo",
						method:"POST",
						data:{chat_message:chat_message, action:action},
						success:function(data){
							$('#group_chat_message').html('');
							$('#group_chat_history').html(data);
						}
					})
				}
				else
				{
					alert('Type something');
				}
			});

			function fetch_group_chat_history()
			{
				var group_chat_dialog_active = $('#is_active_group_chat_window').val();
				var action = "fetch_data";
				if(group_chat_dialog_active == 'yes')
				{
					$.ajax({
						url:"/trabalho-uniasselvi/projeto.view/chat/chat_man.php?evento=chat_em_grupo",
						method:"POST",
						data:{action:action},
						success:function(data)
						{
							$('#group_chat_history').html(data);
						}
					})
				}
			}

			$('#uploadFile').on('change', function(){
				$('#uploadImage').ajaxSubmit({
					target: "#group_chat_message",
					resetForm: true
				});
			});

			$(document).on('click', '.remove_chat', function(){
				var chat_message_id = $(this).attr('id');
				if(confirm("Tem certeza que deseja apagar essa mensagem?"))
				{
					$.ajax({
						url:"/trabalho-uniasselvi/projeto.view/chat/chat_man.php?evento=remover_chat",
						method:"POST",
						data:{chat_message_id:chat_message_id},
						success:function(data)
						{
							update_chat_history_data();
						}
					})
				}
			});
			
		});  
		</script>

		<?php
	}
}

?>
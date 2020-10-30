<?php new TSession; ?>
<html>  
    <head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Chat Interno</title>  

        <link rel="stylesheet" type="text/css" href="/trabalho-uniasselvi/assets/style.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
  		<audio src="/trabalho-uniasselvi/projeto.sound/notificacao.mp3" id="blip"></audio>
        <script src="/trabalho-uniasselvi/js/scripts.js"></script>
    </head>  
    <body>  
        <div class="container">
			<br />
			
			<h3 align="center">Chat Interno</h3><br />
			<br />
			<div class="row">
				<div class="col-md-8 col-sm-6">
					<h4>Usu&aacute;rios Online</h4>
				</div>
				<div class="col-md-2 col-sm-3">
					<input type="hidden" id="is_active_group_chat_window" value="no" />
					<button type="button" name="group_chat" id="group_chat" class="btn btn-warning btn-xs">Chat em grupo</button>
				</div>
				<div class="col-md-2 col-sm-3">
					<p align="right">Ol&aacute; <?php echo Usuarios::getPrimeiroNome($_SESSION["usuario"]->cd_usuario); ?>
				</div>
			</div>
			<div class="table-responsive">
				
				<div id="user_details"></div>
				<div id="user_model_details"></div>
			</div>
			<br />
			<br />	
		</div>	
    </body>  
</html>

<?php ChatMessageForm::chatEmGrupo(); ?>
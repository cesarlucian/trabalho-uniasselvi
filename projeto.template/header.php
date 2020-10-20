<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto</title>
    <link rel="stylesheet" type="text/css" href="/trabalho-uniasselvi/assets/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</head>

    <body>
        <header class="header">
            <div class="title">
                <a class="title-text" href="/trabalho-uniasselvi/inicial.php">
                    Projeto
                </a>  
            </div>


                <nav class="my-dropdown-menu">
                    <i class="glyphicon glyphicon-user"></i>
                    <?php 
                        $usuario = new Usuarios();
                        $usuario->getObject($_SESSION['cd_usuario']);

                        echo $usuario->nm_usuario
                    ?>
                <div class="my-dropdown-items">
                    <ul>
                        <li>
                            <a href="/trabalho-uniasselvi/projeto.view/usuarios/altera_senha.php">Trocar senha</a>
                        </li>
                        <li>
                            <a href="logout.php" >Sair</a>
                        </li>
                    </ul>
                </div>
                </nav>
            
        </header>

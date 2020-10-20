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

<<<<<<< HEAD
                                    <li class="user-header bg-light-blue">
                                        <p>
                                            <small>
                                                <?php 
                                                    $cargo = new Cargos();
                                                    $cargo->getObject($_SESSION['cd_cargo']);
                                                    echo $cargo->ds_cargo;
                                                ?>
                                            </small>
                                        </p>
                                    </li>

                                    <li class="user-footer" style="padding:5px 5px 5px 0px;">
                                        <div class="pull-left">
                                            <a href="/trabalho-uniasselvi/projeto.view/usuarios/altera_senha.php" class="btn btn-default btn-flat">Trocar senha</a>
                                            <a href="/trabalho-uniasselvi/logout.php" class="btn btn-default btn-flat">Sair</a>
                                        </div>
                                    </li>
                                </ul>
=======
                        echo $usuario->nm_usuario
                    ?>
                <div class="my-dropdown-items">
                    <ul>
                        <li>
                            <a href="/trabalho-uniasselvi/projeto.view/usuarios/altera_senha.php">Trocar senha</a>
                        </li>
                        <li>
                            <a href="logout.php" >Sair</a>
>>>>>>> 1ee63e08899abc81866c3e5d94a0d987f70765d4
                        </li>
                    </ul>
                </div>
                </nav>
            
        </header>

<?php new TSession(); ?>

<div class="menu-inicial">
            <aside class="menu-lateral">
                <ul class="sidebar-menu">   

                    <?php switch($_SESSION['usuario']->cd_cargo) { 
                    	case 1:
                    ?>
	                    <li><a href="/trabalho-uniasselvi/inicial.php">Início</a></li>
	                    <li><a href="/trabalho-uniasselvi/projeto.view/alunos/index.php">Alunos</a></li>
                		<li><a href="/trabalho-uniasselvi/projeto.view/chamada/index.php">Chamada</a></li>
                        <li><a href="/trabalho-uniasselvi/projeto.view/faltas/index.php">Faltas</a></li>
	                    <li><a href="/trabalho-uniasselvi/projeto.view/cursos/index.php">Cursos</a></li>
	                    <li><a href="/trabalho-uniasselvi/projeto.view/turmas/index.php">Turmas</a></li>
                        <li><a href="/trabalho-uniasselvi/projeto.view/usuarios/index.php">Usu&aacute;rios</a></li>
	                    
                	<?php

                		break;

                		case 2: ?>

                		<li><a href="/trabalho-uniasselvi/inicial.php">Início</a></li>
                		<li><a href="/trabalho-uniasselvi/projeto.view/alunos/index.php">Alunos</a></li>
                		<li><a href="/trabalho-uniasselvi/projeto.view/chamada/index.php">Chamada</a></li>

                	<?php 

                		break; } ?>
                </ul>
            </aside>
        


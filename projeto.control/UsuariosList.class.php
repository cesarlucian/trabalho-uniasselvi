<?php 

class UsuariosList {

    public function lista($lista_usuarios, $pag,$novo = true){
        ?>
        <main class="card-padrao">
            <form action="edicao.php" name="lista_usuarios" id="lista_usuarios" method="GET" role="form">
                    <div class="box-body">
                        <button type="button" class="btn btn-success pull-right" onclick="window.location = 'cadastro.php'">Inserir novo</button><br><br><br>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Login</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Situa&ccedil;&atilde;o</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($lista_usuarios){
                                        foreach($lista_usuarios as $usuario){ 

                                            ?>
                                                <tr>
                                                    <td align='center'>
                                                        <button alt="Editar" title="Editar" class="btn btn-default btn-sm" type="button" onclick="window.location = 'edicao.php?cd_usuario=<?= $usuario->cd_usuario; ?>'">
                                                            <i class="glyphicon glyphicon-new-window"></i>
                                                        </button>
                                                    </td>   
                                                    <td><?= $usuario->nm_usuario; ?></td>                                         
                                                    <td><?= $usuario->ds_login; ?></td>
                                                    <td><?= $usuario->ds_email; ?></td>
                                                    <td><?php 

                                                        if($usuario->fg_status == "A") {

                                                            $situacao = '<span class="label label-success">Ativo</span>';

                                                        } else {

                                                            $situacao = '<span class="label label-danger">Inativo</span>';
                                                        }

                                                        echo $situacao;

                                                    ?>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7">
                                                        <center>N&atilde;o foram encontrados usu&aacute;rios !</center>
                                                    </td>
                                                </tr>
                                            </tbody>    
                                        <?php
                                    }
                                ?>
                            </tbody>                            
                        </table>
                    </div>
            </form>
            <script>
            </script>
            </main>
        <?php
    }
}

?>
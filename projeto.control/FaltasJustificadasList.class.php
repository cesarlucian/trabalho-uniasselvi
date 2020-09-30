<?php

class FaltasJustificadasList {

	public function lista($lista_faltas, $pag,$novo = true){
        ?>
        <main class="form">
            <form action="edicao.php" name="lista_faltas" id="lista_faltas" method="GET" role="form">
                <div class="box-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                
				                <th scope="col">Aluno</th>
				                <th scope="col">Anexo</th>
				                <th scope="col">Data falta</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($lista_faltas){
                                    foreach($lista_faltas as $falta){  

                                    	$aluno = new Alunos();
                                    	$aluno->getObject($falta->cd_aluno);

                                        $verificaArquivo = new FaltasJustificadas();

                                        ?>
                                            <tr>                                              
                                                <td><?= $aluno->nm_principal; ?></td>
                                                <td><?= $falta->nm_arquivo; ?>
                                                </td>
                                                <td><?= Geral::getDataFormatada($falta->dt_falta); ?></td>

                                                <td align='center'>
                                                    <button alt="Editar" title="Editar" class="btn btn-primary btn-sm" type="button" onclick="window.location = 'analise.php?cd_falta=<?= $falta->cd_falta; ?>'">Analisar   
                                                    </button>
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
                                                    <center>N&atilde;o foram encontrados alunos !</center>
                                                </td>
                                            </tr>
                                        </tbody>    
                                    <?php
                                }
                            ?>
                        </tbody>                            
                    </table>
                </div>
                <div class="col-lg-12 col-md-12"><br>
                        <center>  
                            <a href="/trabalho-uniasselvi/projeto.view/chamada/consulta_chamada.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                        </center>
                    </div> 
            </form>
            <script>
            </script>
            </main>
        <?php
    }
}


?>
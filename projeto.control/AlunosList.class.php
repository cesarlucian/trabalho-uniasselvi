<?php

class AlunosList {

	public function lista($lista_alunos, $pag,$novo = true){
        ?>
            <form action="edicao.php" name="lista_alunos" id="lista_alunos" method="GET" role="form">
                <div class="box box-primary">
                    <div class="box-body">
                        <br>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="headerTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Matrícula</th>
					                <th scope="col">Nome</th>
					                <th scope="col">Status</th>
					                <th scope="col">Curso</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($lista_alunos){
                                        foreach($lista_alunos as $aluno){
                                                                                        
                                            ?>
                                                <tr>                                               
                                                    <td><?= $aluno->nr_matricula; ?></td>
                                                    <td><?= $aluno->nm_principal; ?></td>
                                                    <td>
                                                    	<?php
                                                    		if($aluno->fg_status == "A") {
                                                    			echo "Ativo";
                                                    		} else {
                                                    			echo "Inativo";
                                                    		}
                                                    	?>
                                                    </td>
                                                    <td>Curso aqui</td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td colspan="5">
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
                </div>
            </form>
            <script>
            </script>
        <?php
    }
}
?>
<?php

class FaltasJustificadasForm {

    static function pesquisaFaltaJustificada() {

        ?>

            <main class="form">
                <form action="consulta_faltas.php" method="GET" name="pesquisa_falta" id="pesquisa_falta" role="form">
                    <h3 class="box-title">Consulta de faltas justificadas</h3><br> 
                    <div class="row">
                        <div id="popup_alunos" class="col-lg-9 col-md-9">
                            <label>Aluno</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nm_principal" name="nm_principal" readonly="true"/>
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary" onclick="popUpAluno('pesquisa_falta');">
                                        <i class="fa fa-search"></i>
                                        Buscar
                                    </button>
                                </div>                                        
                            </div>
                            <input type="hidden" class="form-control" id="cd_aluno" name="cd_aluno">
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <label>Data falta</label>
                            <input type="date" class="form-control" name="dt_falta" id="dt_falta">
                        </div> 

                        <div class="col-lg-12 col-md-12"><br>
                            <center>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search">Pesquisar</button>
                                 <a href="/trabalho-uniasselvi/projeto.view/chamada/consulta_chamada.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                            </center>
                        </div>
                    </div> 
                </form>
                <script>
                function popUpAluno(form){
                    window.open('../geral/popups/popup_alunos.php?form='+form, 'JANELA', 'width=800, height=600');
                }
                </script>
            </main>


        <?php
    }

	static function novaFaltaJustificada() {
        ?>

        <main class="form">
            <form class="form" name="nova_falta" id="nova_falta" action="../faltas/faltas_man.php" method="POST" enctype="multipart/form-data">
                <h3 class="box-title">Registro de faltas justificadas</h3><br>
                <input type="hidden" name="evento" id="evento" value="nova_falta" />
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                    </div>
                </div>
                <div class="row">

                    <div id="popup_alunos" class="col-lg-6 col-md-6">
                            <label>Aluno*</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nm_principal" name="nm_principal" readonly="true"/>
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary" onclick="popUpAluno('nova_falta');">
                                        <i class="fa fa-search"></i>
                                        Buscar
                                    </button>
                                </div>                                        
                            </div>
                            <input type="hidden" class="form-control" id="cd_aluno" name="cd_aluno">
                        </div>

                    <div class="col-lg-3 col-md-3">
                        <label>Data falta*</label>
                        <input type="date" class="form-control" name="dt_falta" id="dt_falta" required="true">
                    </div>    

                    <div class="col-lg-3 col-md-3">
                        <label>Anexo documento*</label>
                        <input type="file" class="form-control" name="nm_arquivo" id="nm_arquivo" required="true">
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <br><label for="ds_motivo">Motivo</label><br>
                        <textarea class="form-control" id="ds_motivo" name="ds_motivo" rows="3">
                        </textarea>
                    </div>
                    
                    <div class="col-lg-12 col-md-12"><br>
                        <center>
                            <button type="submit" class="btn btn-success" onclick="return aviso();"><i class="fa fa-search">Registrar</button>
                            <a href="/trabalho-uniasselvi/projeto.view/chamada/consulta_chamada.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>
                        </center>
                    </div> 
                </div>
            </form>
            <script type="text/javascript">
                function popUpAluno(form){
                    window.open('../geral/popups/popup_alunos.php?form='+form, 'JANELA', 'width=800, height=600');
                }

                function aviso() {

                    var nm_principal = document.getElementById('nm_principal').value;

                    if(nm_principal == "") {

                        alert("Campo aluno obrigatório!")
                        return false;

                    } else {

                        return true;
                    }
                }
            </script>
            </main>


        <?php
    }

    static function analisaFaltaJustificada($cd_falta) {

        $falta = new FaltasJustificadas();
        $falta->getObject($cd_falta);

        $aluno = new Alunos();
        $aluno->getObject($falta->cd_aluno);

        ?>

        <main class="form">
            <form class="form" name="analisa_falta" id="analisa_falta" action="../faltas/faltas_man.php" method="POST" enctype="multipart/form-data">
                <h3 class="box-title">An&aacute;lise de faltas justificadas</h3><br>
                <input type="hidden" name="evento" id="evento" value="analisa_falta" />
                <div class="row">

                    <div id="popup_alunos" class="col-lg-8 col-md-8">
                        <label>Aluno*</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nm_principal" name="nm_principal" readonly="true" value="<?= $aluno->nm_principal; ?>"/>                                   
                        </div>
                        <input type="hidden" class="form-control" id="cd_aluno" name="cd_aluno" value="<?= $aluno->cd_aluno; ?>">
                    </div>

                    <div class="col-lg-2 col-md-2">
                        <label>Data falta</label>
                        <input type="text" class="form-control" name="dt_falta" id="dt_falta" value="<?= Geral::getDataFormatada($falta->dt_falta); ?>" readonly="true">
                    </div>    

                    <div class="col-lg-2 col-md-2">
                        <label> &nbsp;</label><br>
                        <input type="hidden" class="form-control" id="nm_arquivo" name="nm_arquivo" value="<?= $falta->nm_arquivo; ?>" readonly="true">                           
                        <button type="button" class="btn btn-primary" onclick="window.open('<?= $falta->getLinkArquivo(); ?>');">
                            Visualizar Documento
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <br><label for="ds_motivo">Motivo</label><br>
                        <input class="form-control" type="text" id="ds_motivo" name="ds_motivo" value="<?= $falta->ds_motivo; ?>" readonly="true">
                        </textarea>
                    </div>
                    
                    <div class="col-lg-12 col-md-12"><br>
                        <center>
                            <button type="button" class="btn btn-success" onclick="aceitarFalta('$falta->cd_falta');"><i class="fa fa-search">Aceitar</button>
                            <button type="button" class="btn btn-danger" onclick="recusarFalta('$falta->cd_falta');"><i class="fa fa-search">Recusar</button>
                             <a href="/trabalho-uniasselvi/projeto.view/faltas/consulta_faltas.php" class="btn btn-primary"><i class="fa fa-search">Voltar</a>   
                        </center>
                    </div> 
                </div>
            </form>
            <script type="text/javascript">
                function aceitarFalta(cd_falta){
                    if(confirm("Aceitar falta justificada?")){
                        window.location = 'faltas_man.php?cd_falta='+cd_falta+'&evento=aceitar_falta';
                    }
                }

                function recusarFalta(cd_falta){
                    if(confirm("Recusar falta justificada?")){
                        window.location = 'faltas_man.php?cd_falta='+cd_falta+'&evento=recusar_falta';
                    }
                }
            </script>
    <?php
    }
}

?>
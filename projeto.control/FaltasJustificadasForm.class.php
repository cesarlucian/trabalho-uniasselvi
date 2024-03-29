<?php

class FaltasJustificadasForm {

	static function novaFaltaJustificadaModal($cd_aluno,$dt_falta) {

        $aluno = new Alunos();
        $aluno->getObject($cd_aluno);

        ?>

        <main class="card-padrao">
            <form name="nova_falta" id="nova_falta" action="../../faltas/faltas_man.php" method="POST" enctype="multipart/form-data">
                <h3 class="box-title">Registro de faltas justificadas</h3><br>
                <input type="hidden" name="evento" id="evento" value="nova_falta" />
                <body onunload="window.opener.location.reload()">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>(*) Campos Obrigat&oacute;rios</label><br><br>
                    </div>
                </div>
                    <div class="row">

                        <div class="col-lg-12 col-md-12">
                            <label>Aluno</label>
                            <input type="hidden" class="form-control" name="cd_aluno" id="cd_aluno" value="<?= $cd_aluno; ?>" readonly="true">
                            <input type="text" class="form-control" name="dt_falta" id="dt_falta" value="<?= $aluno->nm_principal; ?>" readonly="true">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <br><label>Anexo*</label>
                            <input type="file" class="form-control" name="nm_arquivo" id="nm_arquivo" required="true" max-size="20000" accept=".jpeg,.jpg,.png,.pdf,.doc,.docx">
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <br><label>Data falta</label>
                            <input type="date" class="form-control" name="dt_falta" id="dt_falta" value="<?= $dt_falta; ?>" readonly="true">
                        </div> 

                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <br><label>Motivo*</label>
                            <textarea placeholder="Insira o motivo..."class="form-control" name="ds_motivo" id="ds_motivo" maxlength="600" required="true"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12"><br>
                        <center>
                            <button type="submit" class="btn btn-success"><i class="fa fa-search">Registrar</button>
                            <button type="button" onclick="fechaJanela();" class="btn btn-danger"><i class="fa fa-search">Cancelar</a>
                        </center>
                    </div> 
                </div>
            </form>
            <script>
               var uploadField = document.getElementById("nm_arquivo");

                uploadField.onchange = function() {
                    if(this.files[0].size > 30000){
                       alert("Arquivo muito grande! 30kbytes permitido.");
                       this.value = "";
                    };
                };
            
                function fechaJanela() {
                    opener.location.reload();
                    window.close();
                }
            </script>
            </main>


        <?php
    }
}

?>
<?php

// Esta classe e responsavel por manipular os metodos de mostrar mensagem de erro e sucesso, 1 = sucesso , 2 = erro, $texto = mensagem 

class MensagemForm {
    
    static function exibir($tipo, $texto, $bg_color = 'green'){
        
        if($tipo == 1){
            $class_info = 'fa-check';
            $class_alert = 'alert-success';
            //$titulo = 'SUCESSO!';
            $titulo = '';
        }
        else if($tipo == 2){
            $class_info = 'fa-ban';
            $class_alert = 'alert-danger';
            //$titulo = 'ERRO!';
            $titulo = '';
        }
        else if($tipo == 3 || $tipo == 4){                        
            $class_info = 'fa-info-circle';
            $class_alert = 'bg-'.$bg_color;
            //$titulo = 'ERRO!';
            $titulo = '';
        }
        else if($tipo == 5){                        
            $class_info = 'fa-info-circle';
            $class_alert = 'alert-warning';
            //$titulo = 'ERRO!';
            $titulo = '';
        }
        else if($tipo == 6){                        
            $class_info = '';
            $class_alert = 'bg-'.$bg_color;
            //$titulo = 'ERRO!';
            $titulo = '';
        }
        else if($tipo == 7){
            $class_info = '';
            $class_alert = 'alert-success';
            //$titulo = 'SUCESSO!';
            $titulo = '';
        }
        ?>
            <div class="alert <?= $class_alert; ?> alert-dismissible fade in" style='font-size:18px'>
                <i class="fa <?= $class_info; ?>"></i>
                <?php if($tipo < 3){ ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <?php } ?>
                <?= utf8_decode($texto); ?>
            </div>
        <?php
    }
}

<?php

class PaginadorForm {

    static function paginador($pesquisa, $pag, $tot_reg = 0){
        $numeracao = false;
        $tot_pag   = 0;
        
        if($pag <= 1){
            $prev = 1;
            $prev_class = 'disabled';
        }
        else{
            $prev = $pag-1;
            $prev_class = '';
        }
        
        if($tot_reg > 0){
            $numeracao = true;
            
            $tot_pag = intval($tot_reg/6);
            
            if($tot_reg%6 > 0){
               $tot_pag++; 
            }
        }
               
        $purl  = "?pag=".$prev;
        $nurl  = "?pag=".($pag+1);
        
        if(count($pesquisa)){
            
            foreach($pesquisa as $key=>$campo){
                $purl .= "&".$key."=".$campo;
                $nurl .= "&".$key."=".$campo;
            }
        }
        
        ?>
            <ul class='pagination pagination-sm'>
                
                <?php 
                    if($numeracao){                        
                        ?><li class="<?= $prev_class; ?>"><a href="<?= $purl; ?>"><<</a></li><?php
                        
                        if($pag <= 3){
                            $inicio = 1;
                        }
                        else{
                            $inicio = $pag-3;
                        }
                        
                        if($pag+3 < $tot_pag ){
                            $fim = $pag+3;
                        }
                        else{
                            $fim = $tot_pag;
                        }
                        
                        for($i = $inicio; $i <= $fim; $i++){
                            $aurl = "?pag=".($i);
                            foreach($pesquisa as $key=>$campo){
                                $aurl .= "&".$key."=".$campo;
                            }
                            
                            if($i == $pag){
                                ?><li class="disabled"><a href="" class="active  bg-light-blue"><b><?= $i; ?></b></a></li><?php
                            }
                            else{
                                ?><li ><a href="<?= $aurl; ?>"><?= $i; ?></a></li><?php
                            }
                        }
                        
                        if($pag == $tot_pag){
                            ?><li class="disabled"><a href="<?= $nurl; ?>">>></a></li><?php
                        }
                        else{
                            ?><li class=""><a href="<?= $nurl; ?>">>></a></li><?php
                        }
                    }
                    else{
                        ?>
                            <li class="<?= $prev_class; ?>">
                                <a href="<?= $purl; ?>"><<</a>
                            </li>
                            <li>
                                <a href="<?= $nurl; ?>">>></a>
                            </li>
                        <?php
                    }
                ?>
                
            </ul>
        <?php

    }
}

?>
<?php

/*
 Classe: Cargos
 Descrição: classe responsavel por interagir com objeto tipo cargos no banco de dados
*/

class Cargos {

    public $cd_cargo;
    public $ds_cargo;

    const TABLE                 = "cargos";
    const ID                    = "cd_cargo";
    const DIRETORIO             = "projeto.view";
    
    public function getObject($id){
        try{
            TTransaction::open();

            $sql = "SELECT * "
                    . "FROM cargos "
                    . "WHERE cd_cargo = '".$id."' ";

            $conn = TTransaction::get();
            $result = $conn->query($sql);

            $data = $result->fetch(PDO::FETCH_ASSOC);
            unset($conn);

            if(is_array($data)){
                foreach($data as $key=>$campo){
                    $this->$key = $campo;
                }
            
            }
            
        }
        catch (Exception $ex) {   

            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");       
        }
    }

    static function listaCargos(){
        try{
            TTransaction::open();

            $sql = "SELECT * FROM "
                  ."cargos "
                  ."ORDER BY cargos.ds_cargo ";

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $lista_cargos = null;
            if($result){
                foreach($result as $data){

                    $cargo = new Cargos;                    
                    
                    foreach($data as $key=>$campo){
                        $cargo->$key = $campo;
                    }
                    
                    $lista_cargos[] = $cargo;
                    
                    unset($cargo);
                }
                
                if(isset($lista_cargos)){                    
                    return $lista_cargos;
                }
            }  
            unset($conn);
            
            return false;
            
        } catch (Exception $ex) { 

            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");

        }
    }
}

?>
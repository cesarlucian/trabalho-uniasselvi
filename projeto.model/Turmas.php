<?php

/*
 Classe: turmas
 Descrição: classe responsavel por interagir com objeto tipo turmas no banco de dados
*/

class Turmas {

    public $cd_turma;
    public $nr_turma;
    public $cd_curso;

    const TABLE                 = "turmas";
    const ID                    = "cd_turma";
    const DIRETORIO             = "projeto.view";
    
    public function getObject($id){
        try{
            TTransaction::open();

            $sql = "SELECT * "
                    . "FROM turmas "
                    . "WHERE cd_turma = '".$id."' ";

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
        }
    }
    
    public function insert() {
        $colunas = null;
        $valores = null;
        
        try{
            TTransaction::open();

            $sql = "INSERT INTO turmas";
            
            foreach($this as $key=>$campo){
                if($key != 'cd_turma'){
                    if($colunas == ''){
                        $colunas = $key;
                    }
                    else{
                        $colunas .= ', '.$key;
                    }
                    
                    if($valores == ''){
                        $valores = "'".$campo."'";;
                    }
                    else{
                        $valores .= ", '".$campo."'";
                    }                    
                }                
            }
            
            $sql .= " (".$colunas.") VALUES (".$valores.") ";
            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $sql = "select cd_turma "
                    . "from turmas "
                    . "where nr_turma = '".$this->nr_turma."' ";

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $data = $result->fetch(PDO::FETCH_ASSOC);

            foreach($data as $key=>$campo){
                $this->$key = $campo;
            }
            
            TTransaction::close();
            
            return true;
            
        } catch (Exception $ex) {   
            
            echo $ex->getMessage();
            TTransaction::rollback();      
            
            return false;
        }
    }
    
    public function update() {
        $linhas = null;
        
        try{
            TTransaction::open();

            $sql = "UPDATE turmas SET ";
            
            foreach($this as $key=>$campo){
                if($key != 'cd_turma'){
                    if($linhas == ''){
                        $linhas = $key." = '".addslashes($campo)."' ";
                    }
                    else{
                        $linhas .= ", ".$key." = '".addslashes($campo)."' ";
                    }                   
                }                
            }
            
            $sql .= $linhas." WHERE cd_turma = ".$this->cd_turma;

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            TTransaction::close();
            
            return true;
            
        } catch (Exception $ex) {   
            
            echo $ex->getMessage();
            TTransaction::rollback();      
            return false;
        }
    }
    

    static function delete($id) {
        try{
            TTransaction::open();

            $sql = "DELETE FROM turmas WHERE cd_turma = ".$id;
            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            TTransaction::close();
            
            return true;
            
        } catch (Exception $ex) {   

            echo $ex->getMessage();
            TTransaction::rollback();      
            
            return false;
        }
    }

    static function listaNrTurma($cd_curso = null){
        try{
            TTransaction::open();

            if($cd_curso) {

                $sql_turma = "WHERE turmas.cd_curso = '$cd_curso' ";
            }

            $sql = "SELECT cd_turma,nr_turma FROM "
                  ."turmas "
                  ."$sql_turma "
                  ."ORDER BY turmas.cd_curso ";

            //print($sql);

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $lista_turmas = null;
            if($result){
                foreach($result as $data){

                    $turma = new Turmas;                    
                    
                    foreach($data as $key=>$campo){
                        $turma->$key = $campo;
                    }
                    
                    $lista_turmas[] = $turma;
                    
                    unset($turma);
                }
                
                if(isset($lista_turmas)){                    
                    return $lista_turmas;
                }
            }  
            unset($conn);
            
            return false;
            
        } catch (Exception $ex) { 

            echo $ex->getMessage();

        }
    }

    public function verificaTurma($cd_curso,$cd_turma){
        try{
            TTransaction::open();

            $sql = "SELECT * FROM turmas WHERE cd_curso = $cd_curso AND cd_turma = $cd_turma";

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            //print($sql);exit;
            $data = $result->fetch(PDO::FETCH_ASSOC);

            if(empty($data)) {

                return false;

            } else if(!empty($data)){

                return true;
            }

            if(is_array($data)){
                foreach($data as $key=>$campo){
                    $this->$key = $campo;
                }            
            }
            
            //fecha a transação aplicando todas as transações
            TTransaction::close();
            
        } catch (Exception $ex) {
            
        }
    }
}

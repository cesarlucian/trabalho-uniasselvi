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

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");        
        }
    }
    
    public function insert() {
        $colunas = null;
        $valores = null;
        
        try{
            TTransaction::open();

            $sql = "INSERT INTO turmas";
            
            foreach($this as $key=>$campo){
                if($key != 'cd_curso' & $key != 'cd_turma'){
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

            //print($sql);exit;
            
            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $sql = "select cd_turma "
                    . "from turmas "
                    . "where cd_turma = '".$this->cd_turma."' ";

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $data = $result->fetch(PDO::FETCH_ASSOC);

            foreach($data as $key=>$campo){
                $this->$key = $campo;
            }
            
            TTransaction::close();
            
            return true;
            
        } catch (Exception $ex) {   
            
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
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

     static function tornarDisponivel($id) {
        try{
            TTransaction::open();

            $sql = "UPDATE turmas SET cd_curso = NULL WHERE cd_turma = ".$id;
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

            $sql_turma = null;

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

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");

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
            
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
        }
    }

    static function getTotalTurmas($cd_curso){
        try{
            TTransaction::open();

            $sql = "SELECT COUNT(cd_turma) as total "
                    . "FROM turmas "
                    . "WHERE cd_curso = $cd_curso";

            $conn = TTransaction::get();
            $result = $conn->query($sql);

            $data = $result->fetch(PDO::FETCH_ASSOC);
            unset($conn);

            if(is_array($data)){                
                return $data['total'];                           
            }
            
        } catch (Exception $ex) {

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            
        }
    }

    static function listaTurmasDisponiveis() {

        try{

            TTransaction::open();

            $sql = "SELECT * FROM turmas WHERE cd_curso is null";

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

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
        }
    }

    static function listaTurmasPag($nr_turma = null,$filtro_pesquisa = null, $pag = 1){
        try{
            TTransaction::open();

            $sql_turma = $sql_filtro_pesquisa = null;
            
            $offset = (($pag-1)*6);

            $sql_turma = " WHERE nr_turma LIKE '%$nr_turma%' ";

            if($filtro_pesquisa) {

                if($filtro_pesquisa == 1) {

                    $sql_filtro_pesquisa = " AND cd_curso  IS NULL ";

                } else if($filtro_pesquisa == 2) {

                    $sql_filtro_pesquisa = " AND cd_curso IS NOT NULL ";
                }
            } 

            $sql = "SELECT * FROM turmas "
                    ."$sql_turma"
                    ."$sql_filtro_pesquisa"
                    ."ORDER BY cd_curso ASC "  
                    ."LIMIT 6 "
                    ."OFFSET $offset "; 

            //print($sql);

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $lista_cursos = null;
            if($result){
                foreach($result as $data){

                    $curso = new Cursos;                    
                    
                    foreach($data as $key=>$campo){
                        $curso->$key = $campo;
                    }
                    
                    $lista_cursos[] = $curso;
                    
                    unset($curso);
                }
                
                if(isset($lista_cursos)){                    
                    return $lista_cursos;
                }
            }  
            unset($conn);
            
            return false;
            
        } catch (Exception $ex) { 

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");

        }
    }
}

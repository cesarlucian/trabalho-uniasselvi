<?php

/*
 Classe: Alunos
 Descrição: classe responsavel por interagir com objeto tipo alunos no banco de dados
*/

class Alunos {
    public $cd_aluno;
    public $nm_principal;
    public $dt_nascimento;
    public $ds_email;
    public $fg_status;
    public $nr_cpf;
    public $nr_matricula;
    public $ds_endereco;
    public $ds_complemento;
    public $nr_cep;
    public $cd_curso; // foreing key

    const TABLE                 = "alunos";
    const ID                    = "cd_aluno";
    const DIRETORIO             = "projeto.view";
    
    public function getObject($id){
        try{
            TTransaction::open();

            $sql = "SELECT * "
                    . "FROM alunos "
                    . "WHERE cd_aluno = '".$id."' ";

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

            $sql = "INSERT INTO alunos";
            
            foreach($this as $key=>$campo){
                if($key != 'cd_aluno'){
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
            
            $sql = "select cd_aluno "
                    . "from alunos "
                    . "where nm_principal = '".$this->nm_principal."' ";

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

            $sql = "UPDATE alunos SET ";
            
            foreach($this as $key=>$campo){
                if($key != 'cd_aluno'){
                    if($linhas == ''){
                        $linhas = $key." = '".addslashes($campo)."' ";
                    }
                    else{
                        $linhas .= ", ".$key." = '".addslashes($campo)."' ";
                    }                   
                }                
            }
            
            $sql .= $linhas." WHERE cd_aluno = ".$this->cd_aluno;

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

            $sql = "UPDATE alunos SET fg_status = 'I' WHERE cd_aluno = ".$id;
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

    static function listaAlunoPag($filtro, $pag = 1){
        try{
            TTransaction::open();
            
            $offset = (($pag-1)*6);

            // desc filtro

            if($filtro == "") {

                $sql_filtro = " ";

            } else {

                $sql_filtro = "WHERE alunos.nm_principal like '%$filtro%' ";
            }
            
            $sql = "SELECT * FROM alunos "
                  ."$sql_filtro "
                  ."ORDER BY alunos.nm_principal "
                  ."LIMIT 6 "
                  ."OFFSET $offset";

                //print($sql);

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $lista_alunos = null;
            if($result){
                foreach($result as $data){

                    //print_r($data);
                    $aluno = new Alunos;                    
                    
                    foreach($data as $key=>$campo){
                        $aluno->$key = $campo;
                    }
                    
                    $lista_alunos[] = $aluno;
                    
                    unset($aluno);
                }
                
                if(isset($lista_alunos)){                    
                    return $lista_alunos;
                }
            }  
            unset($conn);
            
            return false;
            
        } catch (Exception $ex) { 

            echo $ex->getMessage();

        }
    }
}

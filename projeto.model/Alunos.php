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
    public $nr_cpf;
    public $nr_endereco;
    public $nr_matricula;
    public $ds_endereco;
    public $ds_complemento;
    public $nr_cep;
    public $ds_sexo;
    public $ds_uf;
    public $ds_cidade;
    public $ds_bairro;
    public $fg_status;
    public $cd_turma; // foreing key
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
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            
                    
        }
    }

     static function removerTurma($cd_turma) {
        try{
            TTransaction::open();

            $sql = "UPDATE alunos SET cd_turma = null WHERE cd_turma = ".$id;
            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            TTransaction::close();
            
            return true;
            
        } catch (Exception $ex) {  

            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            TTransaction::rollback();      
            return false;
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
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
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
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            TTransaction::rollback();      
            return false;
        }
    }
    

    static function delete($id) {
        try{
            TTransaction::open();

            $sql = "DELETE FROM alunos WHERE cd_aluno = ".$id;
            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            TTransaction::close();
            
            return true;
            
        } catch (Exception $ex) {   

            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            TTransaction::rollback();      
            return false;
        }
    }

    static function listaAlunosPag($filtro = null,$pesquisa_filtro = null, $pag = 1){
        try{
            TTransaction::open();

            $sql_filtro = null;
            
            $offset = (($pag-1)*6);

            // desc filtro

            switch ($filtro) {
                case '1':
                    $sql_filtro = "WHERE alunos.nm_principal LIKE '%$pesquisa_filtro%' AND alunos.ds_sexo LIKE '%$ds_sexo%' ";
                    break;

                case '2':
                    $sql_filtro = "INNER JOIN cursos USING(cd_curso) WHERE cursos.ds_curso LIKE '%$pesquisa_filtro%' ";
                    break;

                case '3':
                    $sql_filtro = "WHERE alunos.nr_matricula LIKE '%$pesquisa_filtro%' ";
                    break;
                
                default:
                    $sql_filtro = "";
                    break;
            }

            $sql = "SELECT * FROM alunos "
                    ."$sql_filtro"
                    ."ORDER BY alunos.nm_principal "  
                    ."LIMIT 6 "
                    ."OFFSET $offset "; 

            //print($sql);exit;

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $lista_alunos = null;
            if($result){
                foreach($result as $data){

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
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");

        }
    }

    static function listaAlunosModalPag($filtro = null, $pag = 1){
        try{
            TTransaction::open();

            $sql_filtro = null;
            
            $offset = (($pag-1)*6);

            // desc filtro

            if($filtro) {

                $sql_filtro  = "WHERE alunos.nm_principal LIKE '%$filtro%' ";

            }


            $sql = "SELECT * FROM alunos "
                    ."$sql_filtro"
                    ."ORDER BY alunos.nm_principal "  
                    ."LIMIT 6 "
                    ."OFFSET $offset "; 

            //print($sql);

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $lista_alunos = null;
            if($result){
                foreach($result as $data){

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
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");

        }
    }


    static function listaAlunosChamada($cd_curso,$cd_turma){
        try{
            TTransaction::open();

            // desc filtro

            $sql = "SELECT * FROM alunos WHERE cd_turma = $cd_turma 
            and cd_curso = $cd_curso and cd_aluno NOT IN(SELECT cd_aluno FROM chamada WHERE dt_chamada = CURRENT_DATE())"; 

            //print($sql);

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $lista_alunos = null;
            if($result){
                foreach($result as $data){

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
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");

        }
    }

    public function verificaCpfAluno($cpf){
        try{
            TTransaction::open();

            $sql = "SELECT * FROM alunos WHERE nr_cpf = $cpf";

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

            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
        }
    }

    static function getTotalAlunos($cd_curso){
        try{
            TTransaction::open();

            $sql = "SELECT COUNT(cd_aluno) as total "
                    . "FROM alunos "
                    . "WHERE alunos.fg_status = 'A' and cd_curso = $cd_curso";

            $conn = TTransaction::get();
            $result = $conn->query($sql);

            $data = $result->fetch(PDO::FETCH_ASSOC);
            unset($conn);

            if(is_array($data)){                
                return $data['total'];                           
            }
            
        } catch (Exception $ex) {

            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            
        }
    }


    
}

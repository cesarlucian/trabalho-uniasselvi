<?php

class Chamada {

	public $cd_chamada;
	public $situacao_chamada;
	public $ds_motivo;
	public $arquivo_nome;
    public $dt_chamada;
    public $cd_aluno; //fk

	public function getObject($id) {

		try {

			TTransaction::open();

            $sql = "SELECT * "
                    . "FROM chamada "
                    . "WHERE cd_chamada = '".$id."' ";

            $conn = TTransaction::get();
            $result = $conn->query($sql);

            $data = $result->fetch(PDO::FETCH_ASSOC);
            unset($conn);

            if(is_array($data)){
                foreach($data as $key=>$campo){
                    $this->$key = $campo;
                }
            
            }

		} catch(Exception $ex) {

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
			
		}

	}

	public function insert() {
        $colunas = null;
        $valores = null;
        
        try{
            TTransaction::open();

            $sql = "INSERT INTO chamada";
            
            foreach($this as $key=>$campo){
                if($key != 'cd_chamada'){
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
            
            $sql = "select cd_chamada "
                    . "from chamada "
                    . "where cd_chamada = '".$this->cd_chamada."' ";

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
            TTransaction::rollback();      
            
            return false;
        }
    }

    public function update() {
        $linhas = null;
        
        try{
            TTransaction::open();

            $sql = "UPDATE chamada SET ";
            
            foreach($this as $key=>$campo){
                if($key != 'cd_chamada'){
                    if($linhas == ''){
                        $linhas = $key." = '".addslashes($campo)."' ";
                    }
                    else{
                        $linhas .= ", ".$key." = '".addslashes($campo)."' ";
                    }                   
                }                
            }
            
            $sql .= $linhas." WHERE cd_chamada = ".$this->cd_chamada;

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            TTransaction::close();
            
            return true;
            
        } catch (Exception $ex) {   
            
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            TTransaction::rollback();      
            return false;
        }
    }

    static function delete($id) {
        try{
            TTransaction::open();

            $sql = "DELETE FROM chamada WHERE cd_chamada = ".$id;
            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            TTransaction::close();
            
            return true;
            
        } catch (Exception $ex) {   

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            TTransaction::rollback();      
            
            return false;
        }
    }

    public function verificaFalta($cd_aluno, $dt_chamada){
        try{
            TTransaction::open();

            $sql = "SELECT * FROM chamada WHERE cd_aluno = $cd_aluno AND dt_chamada = '$dt_chamada'";

            $conn = TTransaction::get();
            $result = $conn->query($sql);

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

    static function getTotalPresenca($cd_aluno) {
        try{
            TTransaction::open();

            $sql = "SELECT MAX(cd_chamada) as tot_presenca "
                    . "FROM chamada "
                    . "WHERE cd_aluno = $cd_aluno "
                    . "AND situacao_chamada = 'P'";

            //print($sql);
            
            $conn = TTransaction::get();
            $result = $conn->query($sql);

            $data = $result->fetch(PDO::FETCH_ASSOC);
            unset($conn);

            if(is_array($data)){
                foreach($data as $key=>$campo){
                    return $campo;
                }            
            }
            
        } catch (Exception $ex) {
            
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            
        }
    }

    static function getTotalFalta($cd_aluno) {
        try{
            TTransaction::open();

            $sql = "SELECT MAX(cd_chamada) as tot_presenca "
                    . "FROM chamada "
                    . "WHERE cd_aluno = $cd_aluno "
                    . "AND situacao_chamada = 'F'";

            //print($sql);
            
            $conn = TTransaction::get();
            $result = $conn->query($sql);

            $data = $result->fetch(PDO::FETCH_ASSOC);
            unset($conn);

            if(is_array($data)){
                foreach($data as $key=>$campo){
                    return $campo;
                }            
            }
            
        } catch (Exception $ex) {

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            
        }
    }

    public function realizaChamada($cd_aluno,$situacao) {
        $linhas = null;
        
        try{
            TTransaction::open();

            $sql = "INSERT INTO chamada (situacao_chamada,dt_chamada,cd_aluno) values ('$situacao','".date('Y-m-d')."',$cd_aluno)";

            //print($sql);exit;
            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            TTransaction::close();
            
            return true;
            
        } catch (Exception $ex) {   

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            return false;
        }
    }

    public function removeFalta($dt_chamada,$cd_aluno) {
        $linhas = null;
        
        try{
            TTransaction::open();

            $sql = "UPDATE chamada SET situacao_chamada = 'P' WHERE dt_chamada = '$dt_chamada' AND cd_aluno = $cd_aluno";

            print($sql);

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            TTransaction::close();
            
            return true;
            
        } catch (Exception $ex) {

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            return false;
        }
    }

    static function listaFaltasPag($cd_aluno = null,$dt_falta = null,$pag = 1){
        try{
            TTransaction::open();

            $sql_aluno = $sql_data = $sql_ambos = null;
            
            $offset = (($pag-1)*6);

            if($cd_aluno) {

                $sql_aluno = " AND chamada.cd_aluno = $cd_aluno ";
            }

            if($dt_falta) {

                $sql_data = " AND chamada.dt_chamada = '$dt_falta' ";
            }

            if($cd_aluno & $dt_falta) {

                $sql_aluno = "";
                $sql_data = "";
                $sql_ambos = " AND chamada.cd_aluno = $cd_aluno AND chamada.dt_chamada = '$dt_falta' ";
            }

            $sql = "SELECT * FROM chamada "
                    ."WHERE situacao_chamada = 'F' "
                    ."$sql_aluno"
                    ."$sql_data"
                    ."$sql_ambos"
                    ."ORDER BY dt_chamada "  
                    ."LIMIT 6 "
                    ."OFFSET $offset "; 

            print($sql);

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $lista_alunos = null;
            if($result){
                foreach($result as $data){

                    $aluno = new Chamada();                    
                    
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

            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");

        }
    }
}


?>
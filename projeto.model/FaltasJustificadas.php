<?php

class FaltasJustificadas {

	public $cd_falta;
	public $ds_motivo;
	public $nm_arquivo;
	public $dt_falta;
	public $cd_aluno; //fk

    static $url_site = "localhost/";
    // servidor aqui static $url_site = "";

	const TABLE                 = "faltas_justificadas";
    const ID                    = "cd_falta";
    const DIRETORIO             = "projeto.view";

	public function getObject($id) {

		try {

			TTransaction::open();

            $sql = "SELECT * "
                    . "FROM faltas_justificadas "
                    . "WHERE cd_falta = '".$id."' ";

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

    static function delete($id) {
        try{
            TTransaction::open();

            $sql = "DELETE FROM faltas_justificadas WHERE cd_falta = ".$id;
            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
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

	static function listaFaltasJustificadasPag($pag = 1){
        try{
            TTransaction::open();
            
            $offset = (($pag-1)*6);

            // desc filtro

            $sql = "SELECT * FROM faltas_justificadas "
                    ."ORDER BY dt_falta "  
                    ."LIMIT 6 "
                    ."OFFSET $offset "; 

            //print($sql);exit;

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $lista_alunos = null;
            if($result){
                foreach($result as $data){

                    $aluno = new FaltasJustificadas();                    
                    
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

    static function listaFaltasJustificadasPesquisaPag($cd_aluno = null,$dt_falta = null,$pag = 1){
        try{
            TTransaction::open();

            $sql_aluno = $sql_data = $sql_ambos = null;
            
            $offset = (($pag-1)*6);

            if($cd_aluno) {

                $sql_aluno = " WHERE faltas_justificadas.cd_aluno = $cd_aluno ";
            }

            if($dt_falta) {

                $sql_data = " WHERE faltas_justificadas.dt_falta = '$dt_falta'";
            }

            if($cd_aluno & $dt_falta) {

                $sql_aluno = "";
                $sql_data = "";
                $sql_ambos = " WHERE faltas_justificadas.cd_aluno = $cd_aluno AND faltas_justificadas.dt_falta = $dt_falta";
            }

            $sql = "SELECT * FROM faltas_justificadas "
                    ."$sql_aluno"
                    ."$sql_data"
                    ."$sql_ambos"
                    ."ORDER BY dt_falta "  
                    ."LIMIT 6 "
                    ."OFFSET $offset "; 

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $lista_alunos = null;
            if($result){
                foreach($result as $data){

                    $aluno = new FaltasJustificadas();                    
                    
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

	public function adicionaFaltaJustificada($cd_aluno,$dt_falta,$ds_motivo,$nm_arquivo) {
        $linhas = null;
        
        try{
            TTransaction::open();

            $sql = "INSERT INTO faltas_justificadas (dt_falta,ds_motivo,nm_arquivo,cd_aluno) values ('$dt_falta','$ds_motivo','$nm_arquivo',$cd_aluno)";

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

     public function verificaArquivo($cd_falta){
        try{
            TTransaction::open();

            $sql = "SELECT nm_arquivo FROM faltas_justificadas WHERE cd_falta = $cd_falta";

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

    public function getLinkArquivo(){
        return '../../projeto.arquivos/'.$this->nm_arquivo;
    }
}


?>
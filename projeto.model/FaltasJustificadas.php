<?php

/*
 Classe: FaltasJustificadas
 Descrição: classe responsavel por interagir com objeto tipo FaltasJustificadas no banco de dados
*/

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

            echo $ex->getMessage();
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

            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            TTransaction::rollback();      
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

            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            
        }
    }

    public function getLinkArquivo(){
        return '../../projeto.arquivos/'.$this->nm_arquivo;
    }
}


?>
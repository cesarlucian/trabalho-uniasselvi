<?php

class Usuarios {

    public $cd_usuario;
    public $nm_usuario;
    public $ds_email;
    public $ds_login;
    public $ds_senha;
    public $tipo_usuario;
    public $fg_ativo;

    const TABLE                 = "usuarios";
    const ID                    = "cd_usuario";
    const DIRETORIO             = "projeto.view";

    public function getObject($id){
        try{
            TTransaction::open();

            $sql = "SELECT * "
                    . "FROM usuarios "
                    . "WHERE cd_usuario = '".$id."' ";

            $conn = TTransaction::get();
            $result = $conn->query($sql);

            $data = $result->fetch(PDO::FETCH_ASSOC);
            unset($conn);

            if(is_array($data)){
                foreach($data as $key=>$campo){
                    $this->$key = $campo;
                }            
            }

            TTransaction::close();
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
        }
    }

    public function getObjectLogin($ds_login, $ds_senha){
        try{
            TTransaction::open();

            $sql = "SELECT * "
                    . "FROM usuarios "
                    . "WHERE ds_login = '".$ds_login."' and ds_senha = '".$ds_senha."' ";

            $conn = TTransaction::get();
            $result = $conn->query($sql);

            $data = $result->fetch(PDO::FETCH_ASSOC);
            unset($conn);

            if(is_array($data)){
                $usuario = array(
                    'cd_usuario' => $data['cd_usuario'],
                    'nm_usuario' => utf8_encode($data['nm_usuario']), 
                    'ds_email'   => $data['ds_email'],
                    'fg_gestor' => $data['fg_gestor']
                ); 
                
                return $usuario;
            }
            
            return false;
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
        }
    }
    
    public function insert() {
        $colunas = null;
        $valores = null;
        try{
            TTransaction::open();

            $sql = "INSERT INTO usuarios";
            
            foreach($this as $key=>$campo){
                if($key != 'cd_usuario'){
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
            
            $sql = "select cd_usuario from usuarios where nm_usuario = '".$this->nm_usuario."' and ds_login = '".$this->ds_login."'";
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

            $sql = "UPDATE usuarios SET ";
            
            foreach($this as $key=>$campo){
                if($key != 'cd_usuario'){
                    if($linhas == ''){
                        $linhas = $key." = '".$campo."' ";
                    }
                    else{
                        $linhas .= ", ".$key." = '".$campo."' ";
                    }                   
                }                
            }
            
            $sql .= $linhas." WHERE cd_usuario = ".$this->cd_usuario;
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

            $sql = "UPDATE usuarios SET fg_ativo = 0 WHERE cd_usuario = ".$id;
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
    
    static function listaUsuariosPag($filtro = null,$fg_ativo = null, $pag = 1){
        try{
            TTransaction::open();
            $sql_filtro = null;
            
            $offset = (($pag-1)*6);
            
            switch ($filtro) {
                case '1':
                    $sql_filtro = "WHERE fg_ativo = $fg_ativo AND nm_usuario like '%$filtro%' "
                    break;
                case '2':
                    $sql_filtro = "WHERE fg_ativo = $fg_ativo AND ds_login like '%$filtro%' "
                    break;
                
                default:
                    $sql_filtro = "";
                    break;
            }
                        
            $sql = "SELECT * "
                    . "FROM usuarios "
                    . "$sql_filtro "
                    . "$sql_usuario $sql_login "
                    . "ORDER BY nm_usuario "
                    . "LIMIT 6 "
                    . "OFFSET $offset";
            
            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            if($result){
                foreach($result as $data){
                    $usuario = new Usuarios;                    
                    
                    foreach($data as $key=>$campo){
                        $usuario->$key = $campo;
                    }
                    
                    $lista_usuarios[] = $usuario;
                    
                    unset($usuario);
                }
                
                if(isset($lista_usuarios)){                    
                    return $lista_usuarios;
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
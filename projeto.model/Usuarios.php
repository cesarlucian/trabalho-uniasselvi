<?php

class Usuarios {

    public $cd_usuario;
    public $nm_usuario;
    public $ds_email;
    public $ds_login;
    public $ds_senha;
    public $cd_cargo; //fk
    public $fg_status;

    const TABLE                 = "usuarios";
    const ID                    = "cd_usuario";
    const DIRETORIO             = "projeto.view";

    public function verificaUsuarioEmail($login,$email){
        try{
            TTransaction::open();

            $sql = "SELECT * FROM usuarios WHERE ds_login = $login AND ds_email = $email";

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
            fclose($file);
        }
    }

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
            fclose($file);
        }
    }

    static public function getPrimeiroNome($id){
        try{
            TTransaction::open();

            $sql = "SELECT nm_usuario "
                    . "FROM usuarios "
                    . "WHERE cd_usuario = '".$id."' ";

            $conn = TTransaction::get();
            $result = $conn->query($sql);

            $quebra_nome = null;
            $primeiro_nome = null;

            foreach($result as $data) {
                $quebra_nome = explode(" ", $data["nm_usuario"]);
                $primeiro_nome = $quebra_nome[0];
            }

            return $primeiro_nome;

            unset($conn);
            TTransaction::close();
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            fclose($file);
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
            fclose($file);
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
            fclose($file);
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
            fclose($file);
            TTransaction::rollback();      
            return false;
        }
    }
    
    static function delete($id) {
        try{
            TTransaction::open();

            $sql = "DELETE FROM usuarios WHERE cd_usuario = ".$id;
            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            TTransaction::close();
            
            return true;
            
        } catch (Exception $ex) {   
            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            fclose($file);
            TTransaction::rollback();      
            return false;
        }
    }
    
    static function listaUsuariosPag($filtro = null,$pesquisa_filtro = null, $pag = 1){
        try{
            TTransaction::open();
            $sql_filtro = null;
            
            $offset = (($pag-1)*6);
            
            switch ($filtro) {
                case '1':
                    $sql_filtro = "WHERE nm_usuario like '%$pesquisa_filtro%' ";
                    break;
                case '2':
                    $sql_filtro = "WHERE ds_login like '%$pesquisa_filtro%' ";
                    break;
                
                default:
                    $sql_filtro = "";
                    break;
            }
                        
            $sql = "SELECT * "
                    . "FROM usuarios "
                    . "$sql_filtro "
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
            fclose($file);
        }
    }

    static public function getUsuarioChat() {

        try {

            TTransaction::open();

            $sql = "
            SELECT cd_usuario, nm_usuario FROM usuarios 
            WHERE cd_usuario != '".$_SESSION["usuario"]->cd_usuario."' 
            ";

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            $output = '';

            $output = '
            <table class="table table-bordered table-striped">
                <tr>
                    <th width="70%">Nome</td>
                    <th width="20%">Status</td>
                    <th width="10%"></td>
                </tr>
            ';

            foreach($result as $data){

                $status = '';
                $data_hora_atual = strtotime(date("Y-m-d H:i:s") . '- 10 second');
                $data_hora_atual = date('Y-m-d H:i:s', $data_hora_atual);
                $ultima_atividade = LoginDetalhes::buscarUltimaAtividade($data['cd_usuario']);

                if($ultima_atividade > $data_hora_atual)
                {
                    $status = '<span class="label label-success">Online</span>';
                }
                else
                {
                    $status = '<span class="label label-danger">Offline</span>';
                }
                $output .= '
                <tr>
                    <td>'.$data['nm_usuario'].' '.ChatMessage::mensagensNaoVistas($data['cd_usuario'], $_SESSION['usuario']->cd_usuario).' '.LoginDetalhes::verificaSeEstaDigitando($data['cd_usuario']).'</td>
                    <td>'.$status.'</td>
                    <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$data['cd_usuario'].'" data-tousername="'.self::getPrimeiroNome($data['cd_usuario']).'">Iniciar Conversa</button></td>
                </tr>
                ';          
            }

            unset($conn);
            
            $output .= '</table>';
            echo $output;

        } catch(Exception $ex) {

            echo $ex->getMessage();
            $file = fopen("../../projeto.log/log.txt","a+");
            fwrite($file,"Erro: ".$ex->getMessage()." - ".date("Y-m-d H:i:s")."\r\n");
            fclose($file);
        }

    }

}

?>
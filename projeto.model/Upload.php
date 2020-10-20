<?php

/*
 Classe: Upload
 Descrição: classe que possui metodos relacionados a upload de arquivos no sistema
*/

class Upload {

    /*protected $url_ftp              = "111111111111";
    protected $port_ftp             = "58791";
    protected $usuario_ftp          = "ftp";
    protected $senha_ftp            = "11111111111";*/
    
    protected $url_ftp              = "127.0.0.1";
    protected $port_ftp             = "14147";
    protected $usuario_ftp          = "usuario";
    protected $senha_ftp            = "abc123";
    
    public $conecta_ftp;
    static $extensoes_img           = array('jpeg', 'jpg', 'png', 'bmp', 'gif');
    static $extensoes_doc           = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip');
    static $extensoes_txt           = array('txt');
    
    public function conecta(){
        $this->conecta_ftp = ftp_connect($this->url_ftp, $this->port_ftp) or die('Não foi possível se conectar ao servidor');
        $login_ftp   = ftp_login($this->conecta_ftp, $this->usuario_ftp, $this->senha_ftp);
    }
    
    public function criaDiretorio($diretorio){
        $this->conecta();
        if(!ftp_chdir ($this->conecta_ftp , $diretorio)) {
            ftp_mkdir($this->conecta_ftp, $diretorio) or die(print_r(error_get_last()));
        }
        $this->close();
    }
    
    public function efetuaUpload($caminho, $arquivo){
        $this->conecta();
        //echo $caminho.' - '.$arquivo;
        ftp_put($this->conecta_ftp, $caminho, $arquivo, FTP_BINARY) or die(print_r(error_get_last()));
        $this->close();
    }
    
    public function deleteFile($arquivo){
        $this->conecta();
        ftp_delete($this->conecta_ftp, $arquivo);
        $this->close();
    }
    
    public function close(){
        ftp_close($this->conecta_ftp);
    }
    
    static function verificaExtensao($arquivo, $type){        
        $ext = explode('.',$arquivo['name']);
        $extensao = $ext[sizeof($ext)-1];
        $extensao = strtolower($extensao);

        switch ($type){
            case 1:
                if (in_array($extensao, self::$extensoes_img))
                    return true;	
                break;
            case 2:
                if (in_array($extensao, self::$extensoes_doc))
                    return true;
                break;
            case 3:
              	if (in_array($extensao, self::$extensoes_txt))
              		return true;
            	break;
        }
        
        return false;
    } 
    
    public function alteraPermissao($caminho, $permissao){
        $this->conecta();
        chmod($caminho, $permissao);
        $this->close();
    }
    
}
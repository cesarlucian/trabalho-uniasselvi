<?php


/**
 * Classe: Email
 * Descrição: Classe responsável por enviar EMAIL.
 */

class Email {
    
    public $destinatario;
    public $email_destinatario;
    public $email_copia;
    public $titulo;    
    public $mensagem;
    public $arquivo;
    public $arquivo_name;
    public $from_mail;
    public $from;
   
    public function enviar(){   
        try{ 
            
            $mail = new PHPMailer;            
                        
            $mail->isSMTP();
            $mail->From      = $this->from_mail;
            $mail->FromName  = $this->from.' - Projeto 01';

            $mail->AddAddress($this->email_destinatario); //$this->email_destinatario

            if($this->email_copia != '') {
                $copia = explode(';',$this->email_copia);
                if(sizeof($copia) > 1){
                    foreach($copia as $mailCopia){
                        $mail->AddCC($mailCopia);
                    }
                }
                else{
                    $mail->AddCC($this->email_copia);
                }
            }

            $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
            $mail->CharSet = 'ISO-8859-1'; // Charset da mensagem (opcional)

            $mail->Body     = $this->mensagem;        
            $mail->Subject  = $this->titulo;
            
            if($this->arquivo){
                $mail->addAttachment($this->arquivo, $this->arquivo_name);
            }
            
            if($mail->send()){
                //Limpa os destinatários e os anexos
                $mail->ClearAllRecipients();
                $mail->ClearAttachments();
                
                return true;
            }
            else{
                return $mail->ErrorInfo;
            }
        }
        catch (Exception $ex){
            echo $ex->getMessage();
        }
    }
}

?>
<?php

/*
 Classe: cursos
 Descrição: classe responsavel por interagir com objeto tipo cursos no banco de dados
*/

class Cursos {

    public $cd_curso;
    public $fg_status;
    public $ds_curso;

    const TABLE                 = "cursos";
    const ID                    = "cd_curso";
    const DIRETORIO             = "projeto.view";
    
    public function getObject($id){
        try{
            TTransaction::open();

            $sql = "SELECT * "
                    . "FROM cursos "
                    . "WHERE cd_curso = '".$id."' ";

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

            $sql = "INSERT INTO cursos";
            
            foreach($this as $key=>$campo){
                if($key != 'cd_curso'){
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
            
            $sql = "select cd_curso "
                    . "from cursos "
                    . "where ds_curso = '".$this->ds_curso."' ";

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

            $sql = "UPDATE cursos SET ";
            
            foreach($this as $key=>$campo){
                if($key != 'cd_curso'){
                    if($linhas == ''){
                        $linhas = $key." = '".addslashes($campo)."' ";
                    }
                    else{
                        $linhas .= ", ".$key." = '".addslashes($campo)."' ";
                    }                   
                }                
            }
            
            $sql .= $linhas." WHERE cd_curso = ".$this->cd_curso;

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

            $sql = "UPDATE cursos SET fg_status = 'I' WHERE cd_curso = ".$id;
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

    static function listaDescCurso(){
        try{
            TTransaction::open();

            $sql = "SELECT cd_curso,ds_curso FROM "
                  ."cursos WHERE "
                  ."cursos.fg_status = 'A' "
                  ."ORDER BY cursos.ds_curso ";

                // print($sql);

            $conn = TTransaction::get();
            $result = $conn->query($sql);
            
            $lista_cursos = null;
            if($result){
                foreach($result as $data){

                    //print_r($data);
                    $curso = new cursos;                    
                    
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

            echo $ex->getMessage();

        }
    }

    static function campoSelect() {

    	$lista_curso = Cursos::listaDescCurso();

    	?>

    	<select name="cd_curso" id="cd_curso" class="form-control" required="true">
    		<option value="" selected="selected"></option>

    	<?php

    	foreach($lista_curso as $curso) {

    		?>

    		<option value="<?= $curso->cd_curso; ?>"> <?= $curso->ds_curso; ?> </option>

    	<?php

    		} 

    	?>

    	</select>

    	<?php
    }
}

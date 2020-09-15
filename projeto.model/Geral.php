<?php

// Classe responsavel em manipular metodos uteis para uso no decorrer do desenvolvimento da aplicação

class Geral {

    static function validaEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

	static function validaCPF($cpf){

        $j=0;
        for($i=0; $i<(strlen($cpf)); $i++)
            {
                if(is_numeric($cpf[$i]))
                    {
                        $num[$j]=$cpf[$i];
                        $j++;
                    }
            }

        if(count($num)!=11)
            {
                $validaCPF=false;
            }

        else
            {
                for($i=0; $i<10; $i++)
                    {
                        if ($num[0]==$i && $num[1]==$i && $num[2]==$i && $num[3]==$i && $num[4]==$i && $num[5]==$i && $num[6]==$i && $num[7]==$i && $num[8]==$i)
                            {
                                $validaCPF=false;
                                break;
                            }
                    }
            }

        if(!isset($validaCPF))
            {
                $j=10;
                for($i=0; $i<9; $i++)
                    {
                        $multiplica[$i]=$num[$i]*$j;
                        $j--;
                    }
                $soma = array_sum($multiplica);	
                $resto = $soma%11;			
                if($resto<2)
                    {
                        $dg=0;
                    }
                else
                    {
                        $dg=11-$resto;
                    }
                if($dg!=$num[9])
                    {
                        $validaCPF=false;
                    }
            }

        if(!isset($validaCPF))
            {
                $j=11;
                for($i=0; $i<10; $i++)
                    {
                        $multiplica[$i]=$num[$i]*$j;
                        $j--;
                    }
                $soma = array_sum($multiplica);
                $resto = $soma%11;
                if($resto<2)
                    {
                        $dg=0;
                    }
                else
                    {
                        $dg=11-$resto;
                    }
                if($dg!=$num[10])
                    {
                        $validaCPF=false;
                    }
                else
                    {
                        $validaCPF=true;
                    }
            }

        return $validaCPF;					
    }
}


?>
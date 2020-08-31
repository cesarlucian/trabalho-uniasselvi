<?php

require_once("config.php");

/*// FORMULÁRIO
    require_once(dirname(__FILE__) . '/views/templates/header.php');
    require_once(dirname(__FILE__) . '/views/form.php');

    // LISTA DE USUARIOS
    // require_once(dirname(__FILE__) . '/views/templates/header.php');
    // require_once(dirname(__FILE__) . '/views/content.php');
    // require_once(dirname(__FILE__) . '/views/templates/footer.php');*/

$aluno = new Alunos();

// TESTE ALUNOS

/*
campos 

cd_aluno
nm_principal
dt_nascimento
ds_email
fg_status
nr_cpf
nr_matricula
ds_endereco
ds_complemento
nr_cep
cd_curso

*/

/*
$aluno->getObject(1);
// teste pega todos os campos do objeto pelo id
echo $aluno->nm_principal;
*/

/*
$aluno->nm_principal   = "Cesar Fabiano dos Santos";
$aluno->dt_nascimento  = "1998-10-09";
$aluno->ds_email       = "fabiano@hotmail.com";
$aluno->fg_status      = "A";
$aluno->nr_cpf         = "654654847-10";
$aluno->nr_matricula   = "231324";
$aluno->ds_endereco    = "Rua Travessa Escobar, Camaquã";
$aluno->ds_complemento = "AP 2 PREDIO 5";
$aluno->nr_cep         = "84651548";
$aluno->cd_curso       = "2";

$aluno->insert();
*/

/*
$aluno->delete(1);
// deleta um aluno da tabela pelo seu id, altera seu status de A = ativo para I = inativo
*/

/*
// retorna um array com base na pesquisa feita no primeiro parametro, paginado de 6 em 6
$array = $aluno->listaAlunoPag("Cesar");

var_dump($array);
*/

// update alunos

/*
$aluno->getObject(1);

$aluno->nm_principal = "Cesinha pocutom";

if($aluno->update()) {

	echo "Aluno atualizado !";

} else {

	echo "errouuuu";
}
*/


// TESTE CURSO

//$curso = new Cursos();

/*
$curso->getObject(2);

echo $curso->cd_curso;

echo $curso->ds_curso;

*/

/*

$curso->ds_curso = "Curso 9";
$curso->fg_status = "A";

$curso->insert();

*/

/*
$curso->delete(7);
*/

// para fazer update primeiro chamo o objeto que vamos atualizar, e no fim o metodo update()

/*
$curso->getObject(7);

$curso->fg_status = "A";

$curso->update();
*/

/*
// faz um campo select com os cursos na base de dados nao precisamos instanciar pois nao retorna nenhum parametro

Cursos::campoSelect();
*/



?>
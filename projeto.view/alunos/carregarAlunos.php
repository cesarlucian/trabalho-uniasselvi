<?php

define('VIEWS_PATH', realpath(dirname(__FILE__) . '/../projeto.view'));

function carregarAlunos($alunos = []) {
    require_once(realpath(VIEWS_PATH . "/templates/header.php"));
    require_once(realpath(VIEWS_PATH . "/alunosPage.php"));
    require_once(realpath(VIEWS_PATH . "/templates/footer.php"));
}
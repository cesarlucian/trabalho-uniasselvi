<?php

$senha = "senha";

$password_hash = password_hash($senha, PASSWORD_DEFAULT);

echo $password_hash;

?>
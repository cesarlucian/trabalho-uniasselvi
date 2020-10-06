<?php

$senha = "admin123";

$password_hash = password_hash($senha, PASSWORD_DEFAULT);

echo $password_hash;

?>
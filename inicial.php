<?php 

include_once("config.php");
include_once("projeto.template". DIRECTORY_SEPARATOR ."header.php");
include_once("projeto.template". DIRECTORY_SEPARATOR ."menu.php");
include_once("projeto.template". DIRECTORY_SEPARATOR ."inicio.php");
include_once("projeto.template". DIRECTORY_SEPARATOR ."footer.php");

new TSession;

print_r($_SESSION);

extract($_GET);
extract($_POST);

?>


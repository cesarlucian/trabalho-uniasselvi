<?php

include_once("config.php");

new TSession;

TSession::freeSession();

header("location: index.php");

?>

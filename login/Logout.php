<?php
session_start();

if(session_destroy())
	exit(header("Location: ../login/FormLogin.php"));
else echo "deu erro";
?>
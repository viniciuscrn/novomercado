<?php
session_start();
if(empty($_SESSION["nomeprojeto"]))
	$_SESSION["nomeprojeto"] = "novomercado";

require_once ($_SERVER['DOCUMENT_ROOT'] . "/novomercado/bean/Usuario.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/novomercado/dao/UsuarioDAO.php");	

$login = isset($_POST["login"]) ? $_POST["login"] : FALSE;
$senha = isset($_POST["senha"]) ? $_POST["senha"] : FALSE;

if ($login && $senha){

	if($idusuario = UsuarioDAO::fazerLogin($login,$senha)){
		$_SESSION["usuario"] = $idusuario;
		header("Location: ../index.php");
	}else{
		$_SESSION["avisologin"] = "Usuário ou senha inválidos";
		unset($_SESSION["nomeprojeto"]);
		header("Location: ../index.php");
	}	

}else{
	$_SESSION["avisologin"] = "Usuário ou senha não preenchidos";
	unset($_SESSION["nomeprojeto"]);
	header("Location: ../index.php");
}


?>
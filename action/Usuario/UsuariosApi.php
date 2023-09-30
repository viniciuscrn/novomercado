<?php
header("Content-Type:application/json");
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once ($_SERVER['DOCUMENT_ROOT'] . "/novomercado/bean/Usuario.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/novomercado/connection/conexao.php");

		$con = conectar();
		$query = $con -> query("SELECT idusuario,nome,usuario,email,privilegio FROM usuario ORDER BY usuario ASC");
		$usuarios = array();
		while ($row = $query -> fetch(PDO::FETCH_OBJ)) {
			$usuario = new Usuario();
			$usuario -> setIdusuario($row -> idusuario);
			$usuario -> setNome($row -> nome);
			$usuario -> setLogin($row -> usuario);
			$usuario -> setEmail($row -> email);
			$usuario -> setPrivilegio($row -> privilegio);
			array_push($usuarios,$usuario);
		}
		echo json_encode($usuarios);

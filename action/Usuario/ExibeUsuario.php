<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/bean/Usuario.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/dao/UsuarioDAO.php");

$idusuario = isset($_REQUEST["idusuario"]) ? $_REQUEST["idusuario"] : false;

$usuario = UsuarioDAO::pesquisaUsuarioId($idusuario);
?>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php">Início</a></li>
  <li class="breadcrumb-item"><a href="index.php?pg=pesquisarusuario">Usuários</a></li>
  <li class="breadcrumb-item active">Dados do Usuário: <?= $usuario -> getNome() ?></li>
</ol>

<h4>Informações do Usuário:</h4>


	<div class="col-md-4">
		<p>Nome: <strong><?= $usuario -> getNome() ?></strong></p>
	</div>
	<div class="col-md-4">
		<p>Login: <strong><?= $usuario -> getLogin() ?></strong></p>
	</div>
	<div class="col-md-4">
		<p>Email: <strong><?= $usuario -> getEmail() ?></strong></p>
	</div>

	<div class="col-md-4">
		<p>Privilégio: <strong><?php if($usuario -> getPrivilegio() == 1) echo "Administrador"; else echo "Usuário Simples";?></strong></p>
	</div>


<div align="center">
<a href="index.php?pg=atualizausuario&idusuario=<?= $idusuario ?>"><button type="button" class="btn btn-primary">
	Editar Usuário
</button></a> 	
</div>

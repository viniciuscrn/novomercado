<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/novomercado/dao/UsuarioDAO.php");


$idusuario = isset($_POST['idusuario']) ? $_POST['idusuario'] : FALSE;

$usuarioDAO = new UsuarioDAO();

$usuarioDAO -> excluiUsuario($idusuario);

echo "<h3 class='page-header'>Usuário excluído com Sucesso!</h3>";
echo "<div class='actions'>";
echo "<a class='btn btn-success' href='index.php?pg=pesquisarusuario'>Voltar aos Usuários</a>";
echo "<a class='btn btn-default' href='index.php'>Início</a>";
echo "</div>";
?>
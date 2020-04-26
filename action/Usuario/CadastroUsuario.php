<?php 
require_once ($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/bean/Usuario.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/dao/UsuarioDAO.php");

$nome = isset($_POST['nome']) ? $_POST['nome'] : FALSE;
$login = isset($_POST['login']) ? $_POST['login'] : FALSE;
$senha = isset($_POST['senha']) ? $_POST['senha'] : FALSE;
$email = isset($_POST['email']) ? $_POST['email'] : FALSE;
$privilegio = isset($_POST['privilegio']) ? $_POST['privilegio'] : FALSE;

$senhacr = sha1(md5($senha));

$usuario = new Usuario();

$usuario -> setNome($nome);
$usuario -> setLogin($login);
$usuario -> setSenha($senhacr);
$usuario -> setEmail($email);
$usuario -> setPrivilegio($privilegio);

UsuarioDAO::cadastroUsuario($usuario);

echo "<script>location.replace('index.php?pg=listausuarios');</script>";

?>



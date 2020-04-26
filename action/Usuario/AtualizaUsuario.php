<?php 
require_once ($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/bean/Usuario.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/dao/UsuarioDAO.php");

$senhaantiga = isset($_POST['senhaantiga']) ? $_POST['senhaantiga'] : FALSE;
$senha = isset($_POST['senha']) ? $_POST['senha'] : FALSE;

if($senha)
$senhacr = sha1(md5($senha));
else $senhacr = $senhaantiga;

$idusuario = isset($_POST['idusuario']) ? $_POST['idusuario'] : FALSE;
$nome = isset($_POST['nome']) ? $_POST['nome'] : FALSE;
$login = isset($_POST['login']) ? $_POST['login'] : FALSE;
$email = isset($_POST['email']) ? $_POST['email'] : FALSE;
$privilegio = isset($_POST['privilegio']) ? $_POST['privilegio'] : FALSE;

$usuario = new Usuario();

$usuario -> setIdusuario($idusuario);
$usuario -> setNome($nome);
$usuario -> setLogin($login);
$usuario -> setSenha($senhacr);
$usuario -> setEmail($email);
$usuario -> setPrivilegio($privilegio);

UsuarioDAO::editaUsuario($usuario);

?>

echo "<script>location.replace('index.php?pg=listausuarios');</script>";
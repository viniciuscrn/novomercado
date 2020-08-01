<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/connection/conexao.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Usuario.php");

class UsuarioDAO {

	public static function cadastroUsuario($usuario) {

		$nome = $usuario -> getNome();
		$login = $usuario -> getLogin();
		$senha = $usuario -> getSenha();
		$email = $usuario -> getEmail();
		$privilegio = $usuario -> getPrivilegio();

		$con = conectar();

		$stmt = $con -> prepare("INSERT INTO usuario (nome,usuario,senha,email,privilegio) VALUES ( ? , ? , ? , ? , ? )");
		$stmt -> bindParam(1, $nome);
		$stmt -> bindParam(2, $login);
		$stmt -> bindParam(3, $senha);
		$stmt -> bindParam(4, $email);
		$stmt -> bindParam(5, $privilegio);

		try {
			$exe = $stmt -> execute();
			if (!$exe)
				throw new Exception("Erro no cadastro");
		} catch (exception $e) {
			echo $e->getMessage();
		}
	}

	//Função para listar todos os usuários cadastrados
	public static function listaUsuarios() {
		$con = conectar();
		$query = $con -> query("SELECT idusuario,nome,usuario,email,privilegio FROM usuario ORDER BY usuario ASC");
		$usuarios = array();
		$cont = 0;
		while ($row = $query -> fetch(PDO::FETCH_OBJ)) {
			$usuario = new Usuario();

			$usuario -> setIdusuario($row -> idusuario);
			$usuario -> setNome($row -> nome);
			$usuario -> setLogin($row -> usuario);
			$usuario -> setEmail($row -> email);
			$usuario -> setPrivilegio($row -> privilegio);
			$usuarios[$cont] = $usuario;
			$cont++;
		}

		return $usuarios;
	}

	//Função para pesquisar Usuario por ID e retornar um objeto Usuario
	public static function pesquisaUsuarioId($idusuario) {

		$con = conectar();

		$rs = $con -> query("SELECT idusuario,nome,usuario,senha,email,privilegio FROM usuario WHERE idusuario = '$idusuario'");

		$row = $rs -> fetch(PDO::FETCH_OBJ);
		$usuario = new Usuario();
		$usuario -> setIdusuario($row -> idusuario);
		$usuario -> setNome($row -> nome);
		$usuario -> setLogin($row -> usuario);
		$usuario -> setSenha($row -> senha);
		$usuario -> setEmail($row -> email);
		$usuario -> setPrivilegio($row -> privilegio);

		return $usuario;
	}

	//FUnção para editar um Usuario
	public static function editaUsuario($usuario) {

		$idusuario = $usuario -> getIdusuario();
		$nome = $usuario -> getNome();
		$login = $usuario -> getLogin();
		$senha = $usuario -> getSenha();
		$email = $usuario -> getEmail();
		$privilegio = $usuario -> getPrivilegio();

		$con = conectar();

		$stmt = $con -> prepare("UPDATE usuario set nome = :nome, usuario = :login, senha = :senha, email = :email, privilegio = :privilegio 
								WHERE idusuario = '$idusuario'");
		$stmt -> bindValue(':nome', $nome);
		$stmt -> bindValue(':login', $login);
		$stmt -> bindValue(':senha', $senha);
		$stmt -> bindValue(':email', $email);
		$stmt -> bindValue(':privilegio', $privilegio);

		try {
			$exe = $stmt -> execute();
			if (!$exe)
				throw new Exception("Erro na Atualização de usuario");
		} catch (exception $e) {
			echo $e;
		}
	}

	//Função para deletar um usuario
	public static function excluiUsuario($idusuario) {

		$con = conectar();

		$stmt = $con -> prepare("DELETE FROM usuario WHERE idusuario = '$idusuario'");
		try {
			$exe = $stmt -> execute();
			if (!$exe)
				throw new Exception("Erro na Exclusão de Usuario");
		} catch (exception $e) {
			echo $e;
		}
	}

	//Função para fazer login

	public static function fazerLogin($login, $senha) {
		
		$con = conectar();

		$senhacr = sha1(md5($senha));

		$sql = "SELECT idusuario FROM usuario WHERE usuario = '$login' and senha = '$senhacr'";

		$stm = $con -> query($sql);

		if (!empty($stm) && $stm -> rowCount() > 0) {

			$linha = $stm -> fetch(PDO::FETCH_ASSOC);

			return $linha['idusuario'];
			
		} else {
			return false;
		}
	}

	
}
?>

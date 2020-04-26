<?php
class Usuario {

	private $idusuario;
	private $nome;
	private $login;
	private $senha;
	private $email;
	private $privilegio;

	function __construct() {
	}

	public function getIdusuario() {
		return $this -> idusuario;
	}

	public function setIdusuario($idusuario) {
		$this -> idusuario = $idusuario;
	}

	public function getNome() {
		return $this -> nome;
	}

	public function setNome($nome) {
		$this -> nome = $nome;
	}

	public function getLogin() {
		return $this -> login;
	}

	public function setLogin($login) {
		$this -> login = $login;
	}

	public function getSenha() {
		return $this -> senha;
	}

	public function setSenha($senha) {
		$this -> senha = $senha;
	}

	public function getEmail() {
		return $this -> email;
	}

	public function setEmail($email) {
		$this -> email = $email;
	}

	public function getPrivilegio() {
		return $this -> privilegio;
	}

	public function setPrivilegio($privilegio) {
		$this -> privilegio = $privilegio;
	}

}
?>
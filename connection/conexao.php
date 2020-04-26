<?php
function conectar(){
	try{
		$opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
		$con = new PDO("mysql:host=localhost; dbname=novomercado;", "root", "",$opcoes);
		return $con;
	}catch (exception $e){
		echo 'Erro: '.$e->getMessage();
		return null;
	}
}
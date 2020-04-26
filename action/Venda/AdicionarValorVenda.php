<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ProdutoDAO.php");

$valor = str_replace(".", "", $_POST["valor"]);
$valor = str_replace(",", ".", $valor);

$produtoDao = new ProdutoDAO();
$produto = new Produto();

$produto->setQuantvenda(1);
$produto->setCodigo(000);
$produto->setDescricao("Valor Adicionado");
$produto->setPreco($valor);

if(!isset($_SESSION['produtos']))
{
	
	$produto->setItemcompra(1);	
	$produtos = array();
	$produtos[0] = $produto;
	$_SESSION['produtos'] = $produtos;
	 
	 
}else{
	$produtos = unserialize($_SESSION['produtos']);
	
	$ultimo = sizeof($produtos);
	
	$item = count($produtos)+1;
	
	$produto->setItemcompra($item);
	
	$produtos[$ultimo] = $produto;
	
	$_SESSION['produtos'] = $produtos;
}



$produtosSerializados = serialize($_SESSION['produtos']);

$_SESSION['produtos'] = $produtosSerializados;

 

header("Location: index.php?pg=novavenda");

?> 

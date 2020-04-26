<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ProdutoDAO.php");

$item = $_GET['item'];

$produtos = unserialize($_SESSION['produtos']);

foreach ($produtos as $produto) {
	if($produto->getItemCompra() == $item){
		$produto->setDescricao("RETIRADO");
		$produto->setQuantvenda(0);
		$produto->setPreco(0);
	}
}

$produtosSerializados = serialize($produtos);

$_SESSION['produtos'] = $produtosSerializados;

header("Location: index.php?pg=novavenda");
	



?>
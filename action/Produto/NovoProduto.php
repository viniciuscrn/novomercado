<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ProdutoDAO.php");


	$codigo = isset($_POST["codigo"]) ? $_POST["codigo"] : FALSE;
	$descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : FALSE;
	$quantestoque = isset($_POST["quantestoque"]) ? $_POST["quantestoque"] : FALSE;

	//Organizando casas decimais
	$preco = str_replace(".", "", $_POST["preco"]);
	$preco = str_replace(",", ".", $preco);

	if(!ProdutoDAO::existeCodigo($codigo)){

	$produto = new Produto();

	$produto -> setCodigo($codigo);
	$produto -> setDescricao($descricao);
	$produto -> setQuantestoque($quantestoque);
	$produto -> setPreco($preco);

	ProdutoDAO::cadastroProduto($produto);
	
	$_SESSION['mensagem'] = "<div class='alert alert-success'>Produto cadastrado com sucesso.</div>";
	
	header("Location: index.php?pg=novoproduto");
	
	}else{	
	
	echo "<div class='alert alert-warning' align='center'>
		  <h2>O Código deste produto já está cadastrado!</h2>
		  <a href='javascript:window.history.go(-1)'><button class='btn btn-primary'>Voltar</button></a>	
		  </div>";
	}

?>


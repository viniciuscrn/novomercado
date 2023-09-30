<?php 
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ProdutoDAO.php");

$id = isset($_POST["id"]) ? $_POST["id"] : "";
$codigo = isset($_POST["codigo"]) ? $_POST["codigo"] : FALSE;
$descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : FALSE;
$quantestoque = isset($_POST["quantestoque"]) ? $_POST["quantestoque"] : FALSE;

//Organizando casas decimais
$preco = str_replace(".", "", $_POST["preco"]);
$preco = str_replace(",", ".", $preco);

$produto = new Produto();
$produto->setId($id);
$produto->setCodigo($codigo);
$produto->setDescricao($descricao);
$produto->setQuantestoque($quantestoque);
$produto->setPreco($preco);

ProdutoDAO::editaProduto($produto);

$_SESSION['mensagem'] = "<div class='alert alert-success'>Produto atualizado com sucesso.</div>";

echo "<script>location.replace('index.php?pg=formeditaproduto&id=$id');</script>";


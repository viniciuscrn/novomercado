<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ProdutoDAO.php");

$idproduto = isset($_REQUEST["idproduto"]) ? $_REQUEST["idproduto"] : FALSE;

$produto = produtoDAO::pesquisaProdutoId($idproduto);

?>
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.php">Início</a></li>
  <li class="breadcrumb-item"><a href="index.php?pg=pesquisarproduto">Produtos</a></li>
  <li class="breadcrumb-item active">Dados do Produto <?= $produto -> getDescricao() ?></li>
</ol>
<h3 class="page-header">Dados do Produto</h3>

<div class="row">

	<div class="col-md-3">
		<span>Código:</span>
		<p class="lead"><?= $produto -> getCodigo() ?></p>
	</div>

	<div class="col-md-5">
		<span>Descrição:</span>
		<p class="lead"><?= $produto -> getDescricao() ?></p>
	</div>

	<div class="col-md-3">
		<span>Quant. Em Estoque:</span>
		<p class="lead"><?= $produto -> getQuantestoque() ?></p>
	</div>
	
</div>
<hr />
<div class="row">

	<div class="col-md-3">
		<span>Preço de Compra:</span>
		<p class="lead">R$ <?= number_format($produto -> getPrecocompra(),2,",",".") ?></p>
	</div>
	
	<div class="col-md-3">
		<span>Preço de Venda:</span>
		<p class="lead">R$ <?= number_format($produto -> getPrecovenda(),2,",",".") ?></p>
	</div>

</div>

<div align="center">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  	Editar Produto</button>
</div>
<?php
//MODAL Form Produto
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/web/Produto/FormNovoProduto.php");
?>

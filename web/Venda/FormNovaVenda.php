<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ProdutoDAO.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Itensvenda.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ItensvendaDAO.php");
?>

<h3 class="page-header">Venda</h3>
<?php
if(ProdutoDAO::existeProdutoCadastrado()){
$total = 0;
if(isset($_SESSION["itens"])){
	$its = unserialize($_SESSION["itens"]);
	foreach ($its as $it) {
		$prod = ProdutoDAO::pesquisaProdutoId($it -> getProduto_idproduto());
		$subtotal = $prod -> getPrecovenda() * $it -> getQuant();
		$total = $total + $subtotal;
	}
}
?>

<div class="row">
	 <form action="index.php" method="post">
	 <input type="hidden" name="pg" value="pesqprodutovenda" />
	 <div class="form-group col-md-1">
	 	<input type="text" name="quant" id="quant" class="form-control" value="1" />
	 </div> 
	 <div class="form-group col-md-4">
		<input type="text" name="codigo" id="codigo" class="form-control" placeholder="Informe o Códido do Produto" required autofocus="" />
	 </div>
	    <div class="form-group col-md-4">
			<input type="submit" value="Pesquisar" class="btn btn-default"/>
	 	</div>
	 </form>

</div>


<br />

<div class="row">
	<div class="form-group col-md-2">
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
		  	Buscar Produto
		</button>
	</div>
	<div class="form-group col-md-2">	
		<form action="index.php" method="post">
		<input type="hidden" name="pg" value="cancelarvenda" />
		<input type="submit" class="btn btn-warning" value="Cancelar" />
		</form>
	</div>
	<div class="form-group col-md-2">	
		<form action="index.php" method="post">
		<input type="hidden" name="pg" value="troco" />
		<input type="hidden" name="valortotal" value="<?= $total ?>" />
		<input type="submit" class="btn btn-success" value="Finalizar" />
		</form>
	</div>
	<div class="form-group col-md-4">	
	</div>
	<div class="form-group col-md-2">	
		<label for="total">Total R$</label>
		<input type="text" class="form-control input-lg" name="total" value="<?= number_format($total,2,",",".") ?>" />
	</div>
</div>
<?php

	if(isset($_SESSION["itens"]) || !empty($_SESSION["itens"])){
		$itens = array_reverse(unserialize($_SESSION["itens"]));

		echo "<table class='table table-striped'>";

		echo "<tr>";
		echo "<th>item</th>";
		echo "<th>Descrição</th>";
		echo "<th>Preço Unit.</th>";
		echo "<th>Quantidade</th>";
		echo "<th>Sub Total</th>";
		echo "<th>Ação</th>";
		echo "</tr>";
		foreach ($itens as $item) {
			$produto = ProdutoDAO::pesquisaProdutoId($item -> getProduto_idproduto());
			$subtotal = $item -> getQuant() * $produto -> getPrecovenda();
			echo "<tr>";
			echo "<td>". $item -> getNumitem() ."</td>";
			echo "<td>". $produto ->getDescricao() ."</td>";
			echo "<td>". number_format($produto ->getPrecovenda(),2,",",".") ."</td>";
			echo "<td>". $item -> getQuant() ."</td>";
			echo "<td>". number_format($subtotal,2,",",".") ."</td>";
			echo "<td><a href='index.php?pg=retiraitem&numitem=".$item -> getNumitem()."' title='Retirar Item'><span class='glyphicon glyphicon-remove'></span></a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}

//MODAL
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/action/Venda/ListaProdutosVenda.php");
}else{

?>

<div class="alert alert-warning" align="center">
	
	<h2>Nenhum Produto Cadastrado!</h2>
	<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  	Novo Produto
	</button>
	
</div>

<?php
//MODAL
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/web/Produto/FormNovoProduto.php");
}
?>
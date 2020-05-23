<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ProdutoDAO.php");

$codigo = $_POST["codigo"];

if(is_numeric($codigo)){
	if(!ProdutoDAO::existeCodigo($codigo)){
		$_SESSION['mensagem'] = 'Código inexistente';
		header('Location: index.php?pg=formpesquisaproduto'); 
	}
	
	$produto = ProdutoDAO::pesquisaProdutoCodigo($codigo);
	
	
?>
<h4>Dados do Produto</h4>
<hr/>

<p>Código: <strong><?= $produto->getCodigo() ?></strong></p>
<p>Descrição: <strong><?= $produto->getDescricao() ?></strong></p>
<p>Quant. Estoque: <strong><?= $produto->getQuantestoque() ?></strong></p>
<p>Preço: <strong><?= number_format($produto->getPreco(),2,",",".") ?></strong></p>

<p><a href="index.php?pg=formeditaproduto&id=<?= $produto->getId() ?>">Editar Produto</a></p>
<?php	
}else{
	if(!ProdutoDAO::existeDescricao($codigo)){
		$_SESSION['mensagem'] = 'Descrição inexistente';
		header('Location: index.php?pg=formpesquisaproduto'); 
	}
	$produtos = ProdutoDAO::pesquisaProdutoDescricao($codigo);
?>
<h4>Produtos Encontrados</h4>
<hr/>

<table class="table">
	<thead>
		<tr>
			<th width="20%">Código</th>
			<th width="30%">Descrição</th>
			<th width="10%">Quant. Estoque</th>
			<th width="20%">Preço</th>
			<th width="20%">Ações</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($produtos as $produto) { ?>	
		<tr>
			<td><?= $produto->getCodigo() ?></td>
			<td><?= $produto->getDescricao() ?></td>
			<td><?= $produto->getQuantestoque() ?></td>
			<td><?= $produto->getPreco() ?></td>
			<td>
				<a href="index.php?pg=formeditaproduto&id=<?= $produto->getId() ?>" title="Editar Produto"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
				<a href="index.php?pg=excluirproduto&id=<?= $produto->getId() ?>" title="Excluir Produto"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
			</td>
		</tr>
	<?php } ?>	
	</tbody>
</table>

<?php } ?> 



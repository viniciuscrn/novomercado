<?php 
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ProdutoDAO.php");
?>

<h4>Efetuando Venda</h4>
<hr />

	<div class="row">
		<form name="formAdicionaProdutoC" id="formAdicionaProdutoC" action="index.php?pg=addproduto" method="post" autocomplete="off">
			
			<div class="col-md-4">
      			<input type="text" id="codigopr" name="codigopr" class="form-control" placeholder="Código" autofocus required />
			</div>
			<div class="form-group col-md-1">
				<input type="submit" name="adicionarProdutoC" id="adicionarProdutoC" class="btn btn-default" value="Ok"/>	
			</div>
		</form>

		<!-- Formulario para Adicionar Valor -->

		<form name="formAdicionaValor" id="formAdicionaValor" action="index.php?pg=addvalor" method="post">
			<div class="form-group col-md-2">
      			<input type="text" id="valor" name="valor" class="form-control" placeholder="Adicionar um valor" required autocomplete="off" />
			</div>
			<div class="form-group col-md-1">
			<input type="submit" class="btn btn-default" name="adicionarValor" id="adicionarValor" value="Adicionar"/>
		</div>
		</form>

	</div>

		<!-- Tabela dos Produtos da Compra -->
		
		<div id="scroll">
			<table width="880" align="center" class="table">

				<tr>
					<th> Item </th>
					<th width="300" align="center">Descrição do Produto</th>
					<th width="178" align="center">Preço (R$)</th>
					<th width="147" align="center">Quantidade</th>
					<th width="130" align="center">Sub Total (R$)</th>
					<th width="121" align="center">Ação</th>
				</tr>

				<?php
				if (isset($_SESSION['produtos'])) {		
						
					$produtos = array_reverse(unserialize($_SESSION['produtos']));
					$total = 0;
					foreach ($produtos as $produto) {
																	
						?>
						
						<tr>
							<td> <?php echo $produto -> getItemcompra(); ?> </td>
							<td><?php echo $produto -> getDescricao(); ?></td>
							<td><?= number_format($produto -> getPreco(),2,",",".") ?></td>
							<td><?php echo $produto->getQuantvenda(); ?></td>
							<td> <?php 
							$subtotal = $produto->getPreco() * $produto->getQuantvenda();
							$subtotal = number_format($subtotal, 2, '.', '');
							echo number_format($subtotal, 2, ',', '.'); 
							?>
							</td>
							<td><a href="index.php?pg=retiraproduto&item=<?= $produto->getItemCompra() ?>">Retirar</a></td>
						</tr>
						
						<?php
						$total = $total + $subtotal;
						$total = number_format($total, 2, '.', '');
					}
					
					?>
					
					<tr>
						<td colspan="4">Total</td>
						
						<td colspan="2"><?= number_format($total,2,",",".") ?></td>
					</tr>
					
					<div id="totalcompra">
					<a href="index.php?pg=cancela"><button class="btn btn-warning">Cancelar </button></a>
					<a href="index.php?pg=troco&total=<?= $total; ?>"><button class="btn btn-success"> Finalizar Compra</button></a>
					<label for="total" class="total">TOTAL: <input type="text" class="form-control input-lg" name="total" id="total" value="<?= number_format($total,2,",",".") ?>" readonly/></label> 
					</div>
					<hr/>
					<?php

				}
				?>
			</table>
		</div>
		<script>      
		$(function() { $('#valor').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false}); }) 
		</script>
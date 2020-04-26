<?php 
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ProdutoDAO.php");

if(ProdutoDAO::existeProdutoCadastrado()){

$produtos = ProdutoDAO::listaProdutos();

?>

<script> 
	$(document).ready(function(){ 
 
		$('#tabelaProdutos').dataTable({ 
			"bPaginate": true, 
			"iDisplayLength": 10, 
			"oLanguage": { 
				"sProcessing": "Aguarde enquanto os dados são carregados ...", 
				"sLengthMenu": "Mostrar _MENU_ produtos", 
				"sZeroRecords": "Nenhum registro correspondente ao criterio encontrado", 
				"sEmptyTable": "Nenhum Produto Encontrado", 
				"sInfo": "Encontrado(s) _TOTAL_ Produto(s)", 
				"sInfoEmtpy": "Nenhum Produto Encontrado", 
				"sInfoFiltered": "", 
				"sSearch": "Pesquisar Produto", 
				"oPaginate": { 
					"sFirst":    "Primeiro", 
					"sPrevious": "Anterior", 
					"sNext":     "Próximo", 
					"sLast":     "último" 
				} 
			} 
		}); 
	}); 
	</script> 

	<h3 class="page-header">Produtos Encontrados</h3>
	<div align="center">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  	Novo Produto
	</button>
	</div>
			<table id="tabelaProdutos" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead> 
					<tr> 
						<th width="20%">Código</th> 
						<th width="40%">Descricao</th>  
						<th width="20%">Quant. em Estoque</th>  		
						<?php if($us -> getPrivilegio() == 1){ ?>				
						<th width="20%">Ações</th> 
						<?php } ?>
					</tr> 
				</thead> 
		
				<tbody> 
 
					<?php 
						foreach ($produtos as $produto) { 
					?> 
							<tr> 
								<td><?=$produto -> getCodigo()?></td> 
								<td align="center"><?=$produto -> getDescricao()?></td> 
								<td align="center"><?=$produto -> getQuantestoque()?></td>  
								<?php if($us -> getPrivilegio() == 1 || $us -> getPrivilegio() == 2){ ?>
								<td align="center" class="actions">
										<!-- Form Para exibir dados do Produto-->
										<form action="index.php" method="post" style="display: inline; margin: 0px; padding: 0px;"><input type="hidden" name="pg" value="exibeproduto" /><input type="hidden" name="idproduto" value="<?=$produto -> getIdproduto() ?>" /><input type="submit" value="Detalhar" class="btn btn-success" /></form>
										<!-- Form Para editar dados do produto-->
										<form action="index.php" method="post" style="display: inline; margin: 0px; padding: 0px;"><input type="hidden" name="pg" value="editarproduto" /><input type="hidden" name="idproduto" value="<?=$produto -> getIdproduto() ?>" /><input type="submit" value="Editar" class="btn btn-primary"/></form>
										<!-- Form Para excluir um produto-->
										<form action="index.php" method="post" style="display: inline; margin: 0px; padding: 0px;"><input type="hidden" name="pg" value="excluirproduto" />
											<input type="hidden" name="idproduto" value="<?=$produto -> getIdproduto() ?>" />
											<input type="hidden" name="pg" value="excluiproduto" />
											<input type="submit" value="Excluir" class="btn btn-warning" id="btn-apagar"/>
										</form> 
									
								</td>
								<?php } ?>
		 					</tr> 
						<?php 
						} 
						?> 
					</tbody> 
				</table> 
				<?php if($us -> getPrivilegio() == 1 || $us -> getPrivilegio() == 2){

 	}

//MODAL
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/web/Produto/FormNovoProduto.php");

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
<script type="text/javascript">
	$(document).ready(function(){
	   $(".btn-warning").click( function(event) {
	      var apagar = confirm('Deseja realmente excluir este Associado?\nSerão excluídas suas declarações e carteiras geradas, assim como todos os dados dos seus dependentes.');
	      if (apagar){
				window.location = 'index.php';			
	      }else{
	         event.preventDefault();
	      }	
	   });
	});
	</script>
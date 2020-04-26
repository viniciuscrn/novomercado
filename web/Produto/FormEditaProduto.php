<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ProdutoDAO.php");

$id = $_GET["id"];

$produto = ProdutoDAO::pesquisaProdutoId($id);

if(isset($_SESSION["mensagem"])){
  echo $_SESSION["mensagem"];
  unset($_SESSION["mensagem"]);
}

?>
      
      <h4>Editar Produto</h4>
      <hr>
      <form action="index.php?pg=editaproduto" method="post" id="formnovoproduto" data-toggle="validator" role="form" autocomplete="off">
        <input type="hidden" name="id" value="<?= $produto->getId() ?>">
        <div class="row">
      		<div class="form-group col-md-4">
      			<label for="codigo">Código:*</label>
      			<input type="text" id="codigo" name="codigo" class="form-control" data-error="Por favor, informe o Códido do Produto." value="<?= $produto->getCodigo() ?>" required />
			      <div class="help-block with-errors"></div>
      		</div>
         </div> 

        <div class="row">
      		<div class="form-group col-md-8">
      			<label for="descricao">Descrição:*</label>
      			<input type="text" id="descricao" name="descricao" class="form-control" data-error="Por favor, informe a Descrição do Produto." value="<?= $produto->getDescricao() ?>" required />
			      <div class="help-block with-errors"></div>
      		</div>
        </div>

        <div class="row">
      		<div class="form-group col-md-4">
      			<label for="quantestoque">Quant. em Estoque:*</label>
      			<input type="text" id="quantestoque" name="quantestoque" class="form-control" data-error="Por favor, informe a Quantidade do Produto." value="<?= $produto->getQuantestoque() ?>" required />
		  	<div class="help-block with-errors"></div>
      		</div>
        </div>

        <div class="row">
      		<div class="form-group col-md-4">
      			<label for="precovenda">Preço:*</label>
      			<input type="text" id="preco" name="preco" class="form-control" data-error="Por favor, informe o Preço de Venda do Produto." value="<?= number_format($produto->getPreco(),2,",",".") ?>" required />
			<div class="help-block with-errors"></div>
      		</div>
        </div>
    
        <input type="submit" class="btn btn-primary" value="Salvar">
      </div>
      </form> 

<script>      
$(function() { $('#preco').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false}); }) 
</script>

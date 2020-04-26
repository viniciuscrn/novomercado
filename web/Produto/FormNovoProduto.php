<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ProdutoDAO.php");

if(isset($_SESSION["mensagem"])){
  echo $_SESSION["mensagem"];
  unset($_SESSION["mensagem"]);
}
?>
      
      <h4>Cadastro de Novo Produto</h4>
      <hr>
      <form action="index.php?pg=novoproduto" method="post" id="formnovoproduto" data-toggle="validator" role="form" autocomplete="off">

        <div class="row">
      		<div class="form-group col-md-4">
      			<label for="codigo">Código:*</label>
      			<input type="text" id="codigo" name="codigo" class="form-control" data-error="Por favor, informe o Códido do Produto." required />
			      <div class="help-block with-errors"></div>
      		</div>
         </div> 

        <div class="row">
      		<div class="form-group col-md-8">
      			<label for="descricao">Descrição:*</label>
      			<input type="text" id="descricao" name="descricao" class="form-control" data-error="Por favor, informe a Descrição do Produto." required />
			      <div class="help-block with-errors"></div>
      		</div>
        </div>

        <div class="row">
      		<div class="form-group col-md-4">
      			<label for="quantestoque">Quant. em Estoque:*</label>
      			<input type="text" id="quantestoque" name="quantestoque" class="form-control" data-error="Por favor, informe a Quantidade do Produto." required />
		  	<div class="help-block with-errors"></div>
      		</div>
        </div>

        <div class="row">
      		<div class="form-group col-md-4">
      			<label for="preco">Preço:*</label>
      			<input type="text" id="preco" name="preco" class="form-control" data-error="Por favor, informe o Preço de Venda do Produto." required />
			<div class="help-block with-errors"></div>
      		</div>
        </div>
    
        <input type="submit" class="btn btn-primary" value="Salvar">
      </div>
      </form> 

<script>      
$(function() { $('#preco').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false}); }) 
</script>

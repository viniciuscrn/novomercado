<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Cliente.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ClienteDAO.php");

if(isset($_SESSION["mensagem"])){
  echo $_SESSION["mensagem"];
  unset($_SESSION["mensagem"]);
}
?>
      
      <h4>Cadastro de Novo Cliente</h4>
      <hr>
      <form action="index.php?pg=novocliente" method="post" id="formnovocliente" data-toggle="validator" role="form" autocomplete="off">

        <div class="row">
      		<div class="form-group col-md-4">
      			<label for="codigo">Nome:*</label>
      			<input type="text" id="nome" name="nome" class="form-control" data-error="Por favor, informe o Nome do Cliente." required />
			      <div class="help-block with-errors"></div>
      		</div>
         </div> 

		 <div class="row">
      		<div class="form-group col-md-4">
      			<label for="codigo">Telefone:</label>
      			<input type="text" id="telefone" name="telefone" class="form-control" />
      		</div>
         </div> 

		 <div class="row">
      		<div class="form-group col-md-4">
      			<label for="codigo">Rua:</label>
      			<input type="text" id="rua" name="rua" class="form-control" />
      		</div>
         </div> 

		 <div class="row">
      		<div class="form-group col-md-4">
      			<label for="codigo">Bairro:</label>
      			<input type="text" id="bairro" name="bairro" class="form-control" />
      		</div>
         </div> 

		 <div class="row">
      		<div class="form-group col-md-4">
      			<label for="codigo">Cidade:</label>
      			<input type="text" id="cidade" name="cidade" class="form-control" />
      		</div>
         </div> 

		 <div class="row">
      		<div class="form-group col-md-4">
      			<label for="codigo">Estado:</label>
      			<input type="text" id="estado" name="estado" class="form-control" />
      		</div>
         </div> 

		 <div class="row">
      		<div class="form-group col-md-4">
      			<label for="codigo">Data de  Nascimento:</label>
      			<input type="text" id="data" name="data" class="form-control" />
      		</div>
         </div> 

		 <div class="row">
      		<div class="form-group col-md-4">
      			<label for="codigo">Observação:</label>
      			<input type="text" id="obs" name="obs" class="form-control" />
      		</div>
         </div> 
    
        <input type="submit" class="btn btn-primary" value="Salvar">
      </div>
      </form> 

<script>      
$(function() { $('#preco').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false}); }) 
</script>

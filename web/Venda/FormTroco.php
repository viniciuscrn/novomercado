<?php
	
	require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Cliente.php");
	require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ClienteDAO.php");

	$idcliente = isset($_POST["idcliente"]) ? $_POST["idcliente"] : FALSE;
	
	if(isset($_SESSION["valortotal"]))
		$valortotal = $_SESSION["valortotal"];
	else {
		$valortotal = $_POST["valortotal"];
		$_SESSION["valortotal"] = $valortotal;
	}

?>

<!-- PAGAMENTO A VISTA -->
<h2 class="page-header">Finalizando Venda</h2>
<h3 class="page-header">Venda Avulsa - Pagamento à vista</h3>
<form action="index.php" method="post">
<input type="hidden" name="pg" value="finalizavendaavista">
<div class="row">
	<div class="form-group col-md-2">
		<label for="total">Total da Venda</label>
		<input type="text" name="valortotal" id="valortotal" class="form-control input-lg" value="<?= number_format($valortotal,2,",",".") ?>" readonly />

	</div>

	<div class="form-group col-md-2">
		<label for="valorpago">Valor Pago</label>
		<input type="text" name="valorpago" id="valorpago" class="form-control input-lg" />
	</div>

	<div class="form-group col-md-2">
		<label for="troco">Troco</label>
		<input type="text" name="troco" id="troco" class="form-control input-lg" readonly />
	</div>

	<div class="form-group col-md-2">
		
		<input type="submit" value="Encerrar" id="encerrar" class="btn btn-success btn-lg" />
	</div>

</div>
</form>

<!-- Pagamento FIADO -->

<h3 class="page-header">Venda a Cliente - Pagamento Parcelado</h3>
<form action="index.php" method="post">
<input type="hidden" name="pg" value="finalizavendaparcelada">
<div class="row">
	<div class="form-group col-md-2">
		<label for="total">Total da Venda</label>
		<input type="text" name="valortotal" id="valortotal" class="form-control input-lg" value="<?= number_format($valortotal,2,",",".") ?>" readonly />

	</div>

	<div class="form-group col-md-2">
		<label for="valorpago">Valor Recebido</label>
		<input type="text" name="valorrecebido" id="valorrecebido" class="form-control input-lg" value="0" />
	</div>

	<div class="form-group col-md-3">
		<label for="cliente">Cliente</label>

		<?php 
			if($idcliente){
				$cliente = ClienteDAO::pesquisaClienteId($idcliente);
				echo "<input type='text' value='".$cliente -> getNome()."' class='form-control input-lg'>";
				echo "<input type='hidden' name='idcliente' value='".$cliente -> getIdcliente()."'>";
			}else{
		?>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
		  	Buscar Cliente
		</button>
		<?php
			}
		?>	
	</div>


	<div class="form-group col-md-2">
		
		<input type="submit" value="Encerrar" id="encerrar" class="btn btn-success btn-lg" />
	</div>

</div>
</form>

<?php
//MODAL
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/action/Venda/ListaClientesVenda.php");
?>
<script>
	$(function() { $('#valorpago').maskMoney({allowNegative: true, thousands:'.', decimal:',', affixesStay: false}); }) 
	$(function() { $('#valorrecebido').maskMoney({allowNegative: true, thousands:'.', decimal:',', affixesStay: false}); }) 


	$("#valorpago").on("keyup", function() {
	v = parseFloat($("#valorpago").val());
	if(v == 0)
        $("#troco").val(0);
        else{
       	
    vt = $("#valortotal").val().replace(".","");
		vt = vt.replace(",",".");
		
		vp = $("#valorpago").val().replace(".","");
		vp = vp.replace(",",".");
		
		t = vp - vt;	
		$("#troco").val(t.toFixed(2));
	}
});


	$("#encerrar").on("click", function() {
		if(parseFloat($("#valorpago").val()) < parseFloat($("#valortotal").val())){
		alert("Valor Pago Insuficiente!");
		return false;
	}
	});


</script>
<?php 
	$total = $_GET["total"];
?>
<style type="text/css">
	.form-control{
		font-family: Arial Black, Helvetica, sans-serif;
		font-weight:bolder;
		font-size: 70px;
		color:#0000FF;
		height: 110px;
		width: 500px;
        padding: 5px;
	}
	#valorfinal{
		font-family: Arial Black, Helvetica, sans-serif;
		font-weight:bolder;
		font-size: 70px;
		color:red;
		height: 110px;
		width: 500px;
        padding: 5px;
	}
</style>
<h3>FINALIZANDO A COMPRA</h3>
<hr/>
<form action="index.php?pg=finalizavenda" method="post">
<input type="hidden" name="caixa" value="<?= $us->getIdusuario() ?>">	
<div class="row">
	<div class="form-group col-md-6" >
		<p>VALOR PAGO: <input type="text" name="valorpago" id="valorpago" class="form-control input-lg" autocomplete="off" required autofocus></p>
	</div>
	<div class="form-group col-md-6" >
		<p>TOTAL DA COMPRA: <input type="text" name="total" id="total" class="form-control input-lg" value="<?= number_format($total,2,",",".") ?>" readonly></p>
	</div>
</div>		

<div class="row">
	<div class="form-group col-md-6" >
		<p>TROCO: <input type="text" name="troco" id="troco" class="form-control input-lg" readonly></p>
	</div>
	<div class="form-group col-md-6" >
		<p>VALOR FINAL: <input type="text" name="valorfinal" id="valorfinal" class="form-control input-lg" readonly></p>
	</div>
</div>


<div class="row">
	<div class="form-group col-md-6" >
		<p>DESCONTO: <em>(Em %)</em><input type="text" name="desconto" id="desconto" class="form-control input-lg" autocomplete="off"></p>
		<a id="btndesconto" class="btn btn-primary">Incluir desconto</a>
		<a id="btnretiradesconto" class="btn btn-warning">Retirar desconto</a>
	</div>
	<div class="form-group col-md-6" >
		<p>DESCONTO DE:<input type="text" name="totaldesconto" id="totaldesconto" class="form-control input-lg" autocomplete="off" readonly></p>
	</div>
</div>
<input type="submit" value="Finalizar Compra" class="btn btn-success input-lg">
</form>
<hr/>
<a href="index.php?pg=novavenda">Retornar a Compra</a>

<script>
	$( "#valorfinal" ).val($( "#total" ).val());

	$( "#valorpago" ).on("keyup", function() {
		valorpago = $("#valorpago").val();

		v = valorpago.replace(".","");
		v = v.replace(",",".")

		total = $("#total").val();
		t = total.replace(".","");
		t = t.replace(",",".")		

		troco = v - t;
		troco = troco.toLocaleString('pt-br',{currency: 'BRL'});
		total = total.toLocaleString('pt-br',{currency: 'BRL'});

		$("#troco").val(troco);

		$("#valorfinal").val(total);  

		if(v == 0)
			$("#troco").val(0);


	});

	$("#btndesconto").on("click", function(){
	  
		valorpago = $("#valorpago").val();  
		vp = valorpago.replace(".","");
		vp = vp.replace(",",".");

		total = $("#valorfinal").val();  
		t = total.replace(".","");
		t = t.replace(",",".")		

		desconto = $("#desconto").val(); 
		d = desconto.replace(".","");
		d = d.replace(",",".")		

		valortotal = t - (t * d)/100; 

		totaldesconto = t - valortotal; 
		totaldesconto = totaldesconto.toLocaleString('pt-br',{currency: 'BRL'});	
		troco = vp - valortotal;

		troco = troco.toLocaleString('pt-br',{currency: 'BRL'});		

		$("#totaldesconto").val(totaldesconto);
		$("#troco").val(troco);
		valortotal = valortotal.toLocaleString('pt-br',{currency: 'BRL'});	
		$("#valorfinal").val(valortotal);
	});

	$("#btnretiradesconto").on("click", function(){
	    $("#desconto").val(0);
	    $("#valorfinal").val($("#total").val()); 
	    $("#totaldesconto").val(0);

	    valorpago = $("#valorpago").val();

		v = valorpago.replace(".","");
		v = v.replace(",",".")

		total = $("#total").val();
		t = total.replace(".","");
		t = t.replace(",",".")		

		troco = v - t;
		troco = troco.toLocaleString('pt-br',{currency: 'BRL'});
		total = total.toLocaleString('pt-br',{currency: 'BRL'});

		$("#troco").val(troco);


	});

</script>

<script>      
$(function() { $('#valorpago').maskMoney({allowNegative: true, thousands:'.', decimal:',', affixesStay: false}); }) 
</script>

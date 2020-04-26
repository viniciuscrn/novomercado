<h4>Relatório Financeiro por Período</h4>
      <hr>
      <form action="index.php?pg=relatorioperiodo" method="post">

        <div class="row">
      		<div class="form-group col-md-2">
      			<label for="codigo">DE: </label>
      			<input type="text" id="datainicio" name="datainicio" class="form-control" />
      		</div>
            <div class="form-group col-md-2">
      			<label for="codigo">ATÉ: </label>
      			<input type="text" id="datafim" name="datafim" class="form-control" />
      		</div>  
         </div> 
         <input type="submit" class="btn btn-primary" value="Gerar Relatório">

      </form>   
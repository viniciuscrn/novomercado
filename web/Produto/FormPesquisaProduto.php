<h4>Pesquisa de Produtos</h4>
<hr/>
 <?php if(!empty($_SESSION["mensagem"])){ ?>
      <div class="alert alert-danger">
        <?php 
          echo $_SESSION["mensagem"]; 
          unset($_SESSION["mensagem"]);    
        ?>
      </div>
      <?php } ?>   
<form action="index.php?pg=pesquisaproduto" method="post" id="formnovoproduto" autocomplete="off">
        <div class="row">
      		<div class="form-group col-md-4">
      			<label for="codigo">Nome ou código:*</label>
      			<input type="text" id="codigo" name="codigo" class="form-control" autofocus="" required />
      		</div>
         </div> 
         <input type="submit" value="Pesquisar" class="btn btn-primary" name="">
</form>
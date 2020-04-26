
      <div class="content">

	  <h4 class="page-header">Cadastro de Novo Usuário</h4>	

	  <form action="index.php?pg=cadusuario" method="post" id="formnovousuario" data-toggle="validator" role="form">
		
		<input type="hidden" name="idusuario" />
		
		<div class="row">
			<div class="form-group col-md-6">
				<label for="nome">Nome</label>
				<input type="text" class="form-control" name="nome" id="nome" />
			</div>
			
			<div class="form-group col-md-6">
				<label for="login">Login</label>
				<input type="text" class="form-control" name="login" id="login" />
			</div>
			
		</div>
		
		<div class="row">
			
			<div class="form-group col-md-4">
				<label for="senha">Senha</label>
				<input type="password" class="form-control" name="senha" id="senha" />
			</div>
			
			<div class="form-group col-md-4">
				<label for="confirmesenha">Confirme a senha</label>
				<input type="password" class="form-control" name="confirmesenha" id="confirmesenha" />
			</div>
				
		</div>
		
		<div class="row">
			<div class="form-group col-md-6">
				<label for="email">Email</label>
				<input type="text" class="form-control" name="email" id="email"/>
			</div>
			
			<div class="form-group col-md-6">
				<label for="privilegio">Privilegio</label>
				<select name="privilegio" id="privilegio" class="form-control" required>
					<option value="">Escolha</option>
					<option value="1">Administrador</option>
					<option value="2">Usuário Simples</option>
				</select>
			</div>
				
		</div>
	
		<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <input type="submit" class="btn btn-primary" value="Salvar">
      </div>
      </form> 
    </div>
	
<script>
	
	$("#senhasiguais").hide();
	$("#senhasdiferentes").hide();

	$("#confirmesenha").on("keyup", function() {
		if($("#confirmesenha").val() == $("#senha").val()){
			$("#senhasdiferentes").hide();
			$("#senhasiguais").show();
			 $("#cadastrar").removeAttr("disabled");
		}else{
			$("#senhasiguais").hide();
			 $("#senhasdiferentes").show();
			 $("#cadastrar").attr("disabled","disabled");
		}
	});
</script>

<script>

function er_replace( pattern, replacement, subject ){
	return subject.replace( pattern, replacement );
}
	$("#login").keyup(function(){
		var $this = $( this );
		$this.val( er_replace( /[^a-z]+/g,'', $this.val() ) );
	});
	
</script>

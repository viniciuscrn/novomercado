<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/bean/Usuario.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/dao/UsuarioDAO.php");

$idusuario = isset($_GET['idusuario']) ? $_GET['idusuario'] : FALSE;

$usuario = new Usuario();

$usuario = UsuarioDAO::pesquisaUsuarioId($idusuario);

$privilegio = $usuario->getPrivilegio() == 1 ? "Administrador" : "Usuário Simples";

?>

<h3>Atualização de Usuário</h3>

<hr />
		
		<form action="index.php?pg=editausuario" method="post">
			
		<input type="hidden" name="idusuario" value="<?=$idusuario ?>" />	
		
		<div class="row">
			<div class="form-group col-md-6">
				<label for="nome">Nome</label>
				<input type="text" class="form-control" name="nome" id="nome" value="<?=$usuario -> getNome() ?>" required />
			</div>
			
			<div class="form-group col-md-6">
				<label for="login">Login</label>
				<input type="text" class="form-control" name="login" id="login" value="<?=$usuario -> getLogin() ?>" required />
			</div>
			
		</div>
		
		<input type="hidden" name="senhaantiga" id="senhaantiga" size="10" value="<?=$usuario -> getSenha() ?>" />
		<p>Se não for mudar a senha, deixe os campos em branco.</p>
		<div class="row">
			<div class="form-group col-md-6">
				<label for="senha">Nova Senha</label>
				<input type="password" class="form-control" name="senha" id="senha" />
			</div>
			
			<div class="form-group col-md-6">
				<label for="confirmesenha">Confirme a senha</label>
				<input type="password" class="form-control" name="confirmesenha" id="confirmesenha" />
				
			</div>
				
		</div>
		
		<div class="row">
			<div class="form-group col-md-6">
				<label for="email">Email</label>
				<input type="text" class="form-control" name="email" id="email" value="<?=$usuario -> getEmail() ?>" required />
			</div>
			
			<div class="form-group col-md-6">
				<label for="privilegio">Privilegio</label>
				<select name="privilegio" id="privilegio" class="form-control" required>
					<option value="<?=$usuario -> getPrivilegio() ?>"><?php echo $privilegio; ?></option>
					<option value="1">Administrador</option>
					<option value="2">Usuário Simples</option>
				</select>
			</div>
				
		</div>
		
		<input type="submit" class="btn btn-primary" id="cadastrar" value="Atualizar" />
		
		</form>
	
<script>
	$("#senhasiguais").hide();
	$("#senhasdiferentes").hide();

	$("#confirmesenha").on("keyup", function() {
		if ($("#confirmesenha").val() == $("#senha").val() || $("#confirmesenha").val() == "") {
			$("#senhasdiferentes").hide();
			$("#senhasiguais").show();
			$("#atualizar").removeAttr("disabled");
		} else {
			$("#senhasiguais").hide();
			$("#senhasdiferentes").show();
			$("#atualizar").attr("disabled", "disabled");
		}

	});

</script>
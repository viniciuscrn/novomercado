<?php 
require_once ($_SERVER['DOCUMENT_ROOT'] . "/". $_SESSION["nomeprojeto"] . "/dao/UsuarioDAO.php");

$usuarios = UsuarioDAO::listaUsuarios();

?>

<script> 
	$(document).ready(function(){ 
 
		$('#tabelaUsuarios').dataTable({ 
			"bPaginate": false, 
			"iDisplayLength": 3, 
			"oLanguage": { 
				"sProcessing": "Aguarde enquanto os dados são carregados ...", 
				"sLengthMenu": "Mostrar _MENU_ registros por pagina", 
				"sZeroRecords": "Nenhum registro correspondente ao criterio encontrado", 
				"sEmptyTable": "Nenhum Usuário Encontrado", 
				"sInfo": "Encontrado(s) _TOTAL_ Usuario(s)", 
				"sInfoEmtpy": "Nenhum Usuário Encontrado", 
				"sInfoFiltered": "", 
				"sSearch": "Pesquisar Usuário", 
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
	
	<?php if(isset($_GET["mensagem"])){ ?>
	
	<div class="alert alert-success">
	  <strong><?php echo $_GET["mensagem"]; ?></strong> 
	</div>

	<?php } ?>
	
	<h3>Usuários Cadastrados</h3>
	
	<hr />
	
			<table border="0" class="table table-striped table-bordered" id="tabelaUsuarios"> 
				<thead> 
					<tr> 
						<th>Nome</th> 
						<th>Login</th>  
						<th>Email</th>
						<th>Privilégio</th> 
						<th>Ações</th> 
					</tr> 
				</thead> 
				<tbody> 
 
					<?php 
						foreach ($usuarios as $usuario) {
						
						switch ($usuario -> getPrivilegio()) {
							case '1':
								$privilegio = "Administrador";
								break;
							case '2':
								$privilegio = "Usuário Simples";
								break;
							
							default:
								
								break;
						}
							 
					?> 
							<tr> 
								<td><?php echo $usuario -> getNome();?></td> 
								<td align="center"><?php echo $usuario -> getLogin(); ?></td> 
								<td align="center"><?php echo $usuario -> getEmail();?></td>
								<td align="center"><?php echo $privilegio;?></td> 
								
								<td align="center" class="actions">
									
										<form action="index.php?pg=exibeusuario" method="post" style="display: inline; margin: 0px; padding: 0px;">
											<input type="hidden" name="idusuario" value="<?=$usuario -> getIdusuario() ?>" />
											<input type="submit" value="Detalhar" class="btn btn-primary"/>
										</form>
									
										<form action="index.php?pg=excluirusuario" method="post" style="display: inline; margin: 0px; padding: 0px;">
											
											<input type="hidden" name="idusuario" value="<?=$usuario -> getIdusuario() ?>" />
											<input type="submit" value="Excluir" class="btn btn-warning"/>
										</form> 
									
								</td>
				
		 					</tr> 
						<?php 
						} 
						?> 
					</tbody> 
				</table> 
				
				<a  href="index.php?pg=historicoacoes">Histórico de Ações</a>
				
				<!--
				<form action="index.php" method="post">
				<input type="hidden" name="pg" value="cadastrarusuario" />
				<input type="submit" class="btn btn-primary" value="Novo Usuário" />
				</form>
				-->
				<div align="center">
				<a href="index.php?pg=cadastrarusuario"><button type="button" class="btn btn-primary">
					Novo Usuário
				</button></a> 	
				</div>
				<script type="text/javascript">
	$(document).ready(function(){
	   $(".btn-warning").click( function(event) {
	      var apagar = confirm('Deseja realmente excluir este Usuário?');
	      if (apagar){
				window.location = 'index.php';			
	      }else{
	         event.preventDefault();
	      }	
	   });
	});
	</script>


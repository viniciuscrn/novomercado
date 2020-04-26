 <?php
require_once ($_SERVER['DOCUMENT_ROOT']."/FiliacaoApcef/Bean/Logs.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/FiliacaoApcef/dao/LogsDAO.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/FiliacaoApcef/Bean/Usuario.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/FiliacaoApcef/dao/UsuarioDAO.php");

$log = new Logs();
$logDao = new LogsDAO();

$user = new Usuario();
$userDao = new UsuarioDAO();

$logs = array();

$logs = $logDao -> listaLogs();
?>
 
	
 
	<script>
	$(document).ready(function() {

		$('#tabelaLog').dataTable({
			"bPaginate" : false,
			"iDisplayLength" : 3,
			"oLanguage" : {
				"sProcessing" : "Aguarde enquanto os dados são carregados ...",
				"sLengthMenu" : "Mostrar _MENU_ registros por pagina",
				"sZeroRecords" : "Nenhum LOG correspondente ao criterio encontrado",
				"sEmptyTable" : "Nenhum LOG Encontrado",
				"sInfo" : "Encontrado(s) _TOTAL_ LOG(s)",
				"sInfoEmtpy" : "Nenhum LOG Encontrado",
				"sInfoFiltered" : "",
				"sSearch" : "Pesquisar LOG",
				"oPaginate" : {
					"sFirst" : "Primeiro",
					"sPrevious" : "Anterior",
					"sNext" : "Próximo",
					"sLast" : "último"
				}
			}
		});
	});
	</script> 
 	
 	<div>
 		<p>O sistema de LOG (Registros de operações) está guardando informações relativas a procedimentos nos empréstimos. Registrando a data
 		e horário, IP da máquina que realizou a operação, o usuário que fez o procedimento e a mensagem com o tipo de operação. As mensagens
 		devem ser interpretadas como o exemplo a seguir:<br />
 		<strong>| Código da Mensagem | Corpo da Mensagem | Matrícula do Associado que a operação no empréstimo foi realizada | Nome do Usuário que 
 		realizou a operação|</strong> </p><br />
 		<p>
 		 <strong>Código das Mensagens:</strong><br />

 		<strong>MSG 30::</strong> Finalização de Pedido<br/>
 		<strong>MSG 31::</strong> Quitação de Empréstimo<br/>
 		<strong>MSG 32::</strong> Renovação de Empréstimo
 		</p>
 		<br /><br /> <hr /> <br />
 		
 	</div>
 
 
		<div id="geraTabelaLog"> 
			<table border="0" class="display" id="tabelaLog" align="center"> 
				<thead> 
					<tr> 
						<th align="center">Dia / Hora</th> 
						<th align="center">IP</th>  
						<th align="center">Mensagem</th> 
						<th align="center">Usuário</th> 
					</tr> 
				</thead> 
				<tbody> 
 
					<?php 
						foreach ($logs as $log) { 
					?> 
							<tr class="centralizar"> 
								<td><?php 
								$data = date_create($log -> getHora()); 
								echo date_format($data, 'd/m/Y H:i:s'); 
								?></td> 
								<td><?php echo $log -> getIp(); ?></td> 
								<td><?php echo $log -> getMensagem(); ?></td> 
								<td><?php 
										$user = $userDao -> pesquisaUsuarioId($log -> getId_usuario());
										echo $user -> getNome(); 
									?>
								</td>
		 					</tr> 
						<?php
								}
						?> 
					</tbody> 
				</table> 
			</div> 


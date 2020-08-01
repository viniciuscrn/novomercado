<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/dao/ClienteDAO.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/bean/Cliente.php");

$clientedao = new ClienteDAO;
$id = $_POST['id'];

$credito = isset($_POST['credito']) ? $_POST['credito'] : 0.0;
$debito = isset($_POST['debito']) ? $_POST['debito'] : 0.0;

$credito = ClienteDAO::moeda($credito);
$debito = ClienteDAO::moeda($debito);

$cliente = $clientedao->pesquisaClienteId($id);

if($cliente->getSaldo() < $debito){
     $_SESSION['mensagem'] = "<div class='alert alert-danger'>Valor de Débito maior que o Saldo.</div>";
     header("Location: index.php?pg=detalharcliente&id=$id");
     return false;
}

ClienteDAO::pagamento($id,$credito,$debito);

$tipo = $credito == 0 ? 'DEBITADO' : 'CREDITADO';
$valor = $credito == 0 ? $debito : $credito;

if(isset($_SESSION["produtos"]))
    unset($_SESSION["produtos"]);

$_SESSION['mensagem'] = "<div class='alert alert-success'>Valor de <strong> R$ ". number_format($valor,2,',','.')." $tipo </strong>com sucesso.</div>";
	
header("Location: index.php?pg=detalharcliente&id=$id");



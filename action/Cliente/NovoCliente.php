<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Cliente.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ClienteDAO.php");

$nome = isset($_POST["nome"]) ? $_POST["nome"] : FALSE;
$telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : FALSE;
$rua = isset($_POST["rua"]) ? $_POST["rua"] : FALSE;
$bairro = isset($_POST["bairro"]) ? $_POST["bairro"] : FALSE;
$cidade = isset($_POST["cidade"]) ? $_POST["cidade"] : FALSE;
$estado = isset($_POST["estado"]) ? $_POST["estado"] : FALSE;
$data = isset($_POST["data"]) ? $_POST["data"] : FALSE;
$obs = isset($_POST["obs"]) ? $_POST["obs"] : FALSE;
$debito = isset($_POST["debito"]) ? $_POST["debito"] : FALSE;
$credito = isset($_POST["credito"]) ? $_POST["credito"] : FALSE;
$saldo = isset($_POST["saldo"]) ? $_POST["saldo"] : FALSE;

$cliente = new Cliente();

$cliente -> setNome($nome);
$cliente -> setTelefone($telefone);
$cliente -> setRua($rua);
$cliente -> setBairro($bairro);
$cliente -> setCidade($cidade);
$cliente -> setEstado($estado);
$cliente -> setData($data);
$cliente -> setObs($obs);
$cliente -> setDebito($debito);
$cliente -> setCredito($credito);
$cliente -> setSaldo($saldo);

if(ClienteDAO::cadastroCliente($cliente)){
?>
<div class="container">
<p class="alert alert-success">Cliente Cadastrado com Sucesso!.</p>

<a href='index.php?pg=cadastrarcliente' class='btn btn-primary'>Cadastrar novo Cliente</a>

<a href='index.php' class='btn btn-default'>Início</a>
</div>
<?php } ?>

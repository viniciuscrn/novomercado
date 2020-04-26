<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/VendaDAO.php");

$total = str_replace(".", "", $_POST["valorfinal"]);
$total = str_replace(",", ".", $total);
$caixa = $_POST["caixa"];


$dia = date("Y-m-d");

$vendaDAO = new VendaDAO();

$vendaDAO->novaVenda($total,$dia,$caixa);

unset($_SESSION["produtos"]);

header("Location:index.php?pg=novavenda");

?>


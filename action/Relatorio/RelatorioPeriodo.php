<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/". $_SESSION["nomeprojeto"] . "/dao/VendaDAO.php");

$usuarios = UsuarioDAO::listaUsuarios();

$datainicio = VendaDAO::inverteData($_POST["datainicio"]);
$datafim = VendaDAO::inverteData($_POST["datafim"]);

?>

<h4>RELATÓRIO FINANCEIRO DE <u><?= $_POST["datainicio"] ?> A <?= $_POST["datafim"] ?></u></h4>

<table class="table">
<thead>
    <th>Caixa</th>
    <th>Valor Vendido</th>
</thead>
<tbody>
<?php
    $totalgeral = 0;
    foreach($usuarios as $usuario){
        $total = VendaDAO::calculavendascaixa($datainicio, $datafim, $usuario->getIdusuario());
        echo "<tr><td>" . $usuario->getNome() . "</td>";
        echo "<td>R$ " . number_format($total,2,",",".") . "</td></tr>";
        $totalgeral += $total;
    } 
?>
<tr>
<td>Total Geral no período:</td>
<td><strong>R$ <?= number_format($totalgeral,2,",",".") ?></strong></td>
<tr>
</tbody>
</table>
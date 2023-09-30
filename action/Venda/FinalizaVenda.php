<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/dao/VendaDAO.php");

$total = str_replace(".", "", $_POST["valorfinal"]);
$total = str_replace(",", ".", $total);
$caixa = $_POST["caixa"];


$dia = date("Y-m-d");

$vendaDAO = new VendaDAO();

//$vendaDAO->novaVenda($total,$dia,$caixa);
//unset($_SESSION["produtos"]);
$produtos = array_reverse(unserialize($_SESSION['produtos']));

?>
<i><?php echo Date('d/m/Y h:i:s') ?></i>
<h3>Mercado Nossa Senhora de Lourdes</h3>
<p>Rua Padre Aristides, Centro, Água Branca - PB</p>
<p>Tel: 83 998821873</p>
<table width="400">
    <tr>
        <th> Item </th>
        <th width="300" align="center">Descrição</th>
        <th width="178" align="center">Preço (R$)</th>
        <th width="147" align="center">Quantidade</th>
        <th width="130" align="center">Sub Total (R$)</th>
    </tr>

    <?php
    if (isset($_SESSION['produtos'])) {

        $produtos = array_reverse(unserialize($_SESSION['produtos']));
        $total = 0;
        foreach ($produtos as $produto) {

    ?>
            <tr>
                <td> <?php echo $produto->getItemcompra(); ?> </td>
                <td><?php echo $produto->getDescricao(); ?></td>
                <td><?= number_format($produto->getPreco(), 2, ",", ".") ?></td>
                <td><?php echo $produto->getQuantvenda(); ?></td>
                <td> <?php
                        $subtotal = $produto->getPreco() * $produto->getQuantvenda();
                        $subtotal = number_format($subtotal, 2, '.', '');
                        echo number_format($subtotal, 2, ',', '.');
                        ?>
                </td>
            </tr>

        <?php
            $total = $total + $subtotal;
            $total = number_format($total, 2, '.', '');
        }

        ?>

        <tr>
            <td colspan="4">Total</td>

            <td colspan="2"><?= number_format($total, 2, ",", ".") ?></td>
        </tr>
    <?php

    }
    ?>
</table>
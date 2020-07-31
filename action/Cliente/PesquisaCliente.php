<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/bean/Cliente.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/dao/ClienteDAO.php");

$clientes = ClienteDAO::listaclientes();

?>

<h4>Lista de Clientes</h4>
<hr>

<table id="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($clientes as $cliente) {
        ?>
            <tr>
                <th><?= $cliente->getNome() ?></th>
                <th><?= $cliente->getRua() ?></th>
                <th><?= $cliente->getTelefone() ?></th>
                <th><a href="index.php?pg=detalharcliente&id=<?= $cliente->getId()?>">Detalhar</a></th>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "sSearch": "Pesquisar",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
            },
        })
    });
</script>
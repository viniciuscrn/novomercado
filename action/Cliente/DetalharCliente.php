<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/bean/Cliente.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/dao/ClienteDAO.php");

$id = $_REQUEST["id"];
$cliente = ClienteDAO::pesquisaClienteId($id); ?>

<h4><?= strtoupper($cliente->getNome()) ?></h4>
<hr>
<ul class="list-group">
    <li class="list-group-item">Nome: <?= $cliente->getNome() ?></li>
    <li class="list-group-item">Telefone: <?= $cliente->getTelefone() ?></li>
    <li class="list-group-item">Endereço: <?= $cliente->getRua(). ", " . $cliente->getBairro() . ", " . $cliente->getCidade() . " - " . $cliente->getEstado() ?></li>
    <li class="list-group-item">Data de Nascimento: <?= $cliente->getData() ?></li>
    <li class="list-group-item">Observações: <?= $cliente->getObs() ?></li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-3">
            <strong>SALDO DEVEDOR:</strong> <input type="text" id="saldo" class="input" value="<?= number_format($cliente->getSaldo(),2,',','.') ?>" readonly>
            </div>
            <form action="index.php?pg=pagamento" method="post">
                <input type="hidden" name="id" value="<?= $cliente->getId() ?>">
            <div class="col-md-3">
            <strong class="alert-danger">CREDITAR VALOR:</strong> <input type="text" name="credito" id="credito" class="input" value="0">
            </div>
            <div class="col-md-3">
            <strong class="alert-success">DEBITAR VALOR:</strong> <input type="text" name="debito" id="debito" class="input" value="0">
            </div>
            <div class="col-md-3">
                <input type="submit" class="btn btn-primary" value="Aplicar Alterações" id="alterar"/>
            </div>
            </form>
        </div>    
    </li>
    <li class="list-group-item">
            <?php
                if(isset($_SESSION['mensagem'])){
                    echo $_SESSION['mensagem'];
                    unset($_SESSION['mensagem']);
                }    
            ?>
    </li>
</ul>
<script>      
$(function() { $('#credito').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false}); }), 
$(function() { $('#debito').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false}); }) 
</script>
<script>
    
    $(document).ready(function(){
        $('#alterar').click(function(){
            if($('#credito').val()==0 && $('#debito').val()==0){
                alert('Preencher um valor de Crédito ou de Débito.');
                return false;
            }
        })

        $( "#credito" ).keypress(function() {
            $("#debito").val(0);
        });

        $( "#debito" ).keypress(function() {
            $("#credito").val(0);
        });
    })
</script>
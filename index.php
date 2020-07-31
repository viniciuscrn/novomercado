<?php
session_start();

if (empty($_SESSION["nomeprojeto"]))
    $_SESSION["nomeprojeto"] = "novomercado";

require_once($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/dao/UsuarioDAO.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/bean/Usuario.php");

if (empty($_SESSION["usuario"]) || !isset($_SESSION["usuario"]))
    header("Location: login/FormLogin.php");
else
    $idusuario = intval($_SESSION["usuario"]);

$us = UsuarioDAO::pesquisaUsuarioId($idusuario);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>:: MERCADO NOSSA SENHORA DE LOURDES ::</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="css/datatables.min.css">
    <script src="js/JQuery.min.js"></script>
    <style>
        .input{
            height: 50px;
            width: 250px;;
            border-radius: 5px;
            font-size: 3em;
            font-weight: bolder;
        }

        .input:read-only{
            height: 50px;
            width: 250px;;
            border-radius: 5px;
            font-size: 3em;
            font-weight: bolder;
            background-color: #FF6347;
        }
    </style>
</head>

<body>
    <!-- BArra de Navegação -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Mercado Nossa Senhora de Lourdes</a>
                <p class="navbar-text pull-right">Olá <?= $us->getNome() ?>!</p>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Início</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Produtos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?pg=formpesquisaproduto">Pesquisar</a></li>
                            <li><a href="index.php?pg=formnovoproduto">Novo</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Clientes <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?pg=formpesquisacliente">Pesquisar</a></li>
                            <li><a href="index.php?pg=formnovocliente">Novo</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Vendas <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?pg=novavenda">Nova</a></li>
                        </ul>
                    </li>
                    <?php if ($us->getPrivilegio() == 1) {  ?>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuários <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="index.php?pg=listausuarios">Pesquisar</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Relatórios <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="index.php?pg=relatorios">Financeiro</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <li><a href="login/Logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Conteúdo Principal -->
    <div id="main" class="container">
        <?php
        if (isset($_REQUEST["pg"])) {
            switch ($_REQUEST["pg"]) {

                case "home":
                    include "Web/home.php";
                    break;

                    //USUÁRIOS
                case "cadastrarusuario":
                    include "web/Usuario/FormNovoUsuario.php";
                    break;

                case "cadusuario":
                    include "action/Usuario/CadastroUsuario.php";
                    break;

                case "exibeusuario":
                    include "action/Usuario/ExibeUsuario.php";
                    break;

                case "atualizausuario":
                    include "web/Usuario/FormAtualizaUsuario.php";
                    break;

                case "editausuario":
                    include "action/Usuario/AtualizaUsuario.php";
                    break;

                case "excluirusuario":
                    include "action/Usuario/ExcluirUsuario.php";
                    break;

                case "listausuarios":
                    include "action/Usuario/ListaUsuarios.php";
                    break;

                    //Produtos
                case "formnovoproduto":
                    include "web/Produto/FormNovoProduto.php";
                    break;

                case "novoproduto":
                    include "action/Produto/NovoProduto.php";
                    break;

                case "formpesquisaproduto":
                    include "web/Produto/FormPesquisaProduto.php";
                    break;

                case "pesquisaproduto":
                    include "action/Produto/PesquisaProduto.php";
                    break;

                case "formeditaproduto":
                    include "web/Produto/FormEditaProduto.php";
                    break;
                case "editaproduto":
                    include "action/Produto/EditaProduto.php";
                    break;

                    //Clientes
                case "formnovocliente":
                    include "web/Cliente/FormNovoCliente.php";
                    break;

                case "novocliente":
                    include "action/Cliente/NovoCliente.php";
                    break;

                case "formpesquisacliente":
                    include "action/Cliente/PesquisaCliente.php";
                    break;

                case "detalharcliente":
                    include "action/Cliente/DetalharCliente.php";
                    break;

                    case "pagamento":
                        include "action/Cliente/Pagamento.php";
                        break;    

                    //VENDAS    
                case "novavenda":
                    include "action/Venda/NovaVenda.php";
                    break;

                case "addproduto":
                    include "action/Venda/PesquisaProdutoVenda.php";
                    break;

                case "troco":
                    include "action/Venda/Troco.php";
                    break;

                case "cancela":
                    include "action/Venda/Cancela.php";
                    break;

                case "addvalor":
                    include "action/Venda/AdicionarValorVenda.php";
                    break;

                case "retiraproduto":
                    include "action/Venda/RetiraProduto.php";
                    break;

                case "finalizavenda":
                    include "action/Venda/FinalizaVenda.php";
                    break;

                    //RELATÓRIOS    

                case "relatorios":
                    include "web/Relatorio/FormRelatorioPeriodo.php";
                    break;

                case "relatorioperiodo":
                    include "action/Relatorio/RelatorioPeriodo.php";
                    break;


                case "logout":
                    include "login/Logout.php";
                    break;
            }
        } else {
            include "web/home.php";
        }
        ?>
    </div>
</body>
<script type="text/javascript">
    function popupform(url) {
        window.open('', 'Popup', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=yes, width=650, height=380');
        document.form.submit();
    }
</script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.min.js"></script>
<script src="js/maskmoney.js"></script>
<script src="js/jquery.mask.js"></script>
<script src="js/mascaras.js"></script>
<script src="js/datatables.min.js"></script>

</html>
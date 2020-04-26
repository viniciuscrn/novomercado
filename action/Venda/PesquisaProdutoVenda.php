<?php
//session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/".$_SESSION["nomeprojeto"]."/dao/ProdutoDAO.php");

$codigop = $_POST['codigopr'];

$nc = strlen($codigop);
$posicao = FALSE;
for ($i = 0; $i < $nc; $i++) {
	if ($codigop[$i] == "*")
		$posicao = $i;
}
if ($posicao) {
	$quant = substr($codigop, 0, $posicao);
	$codigo = substr($codigop, $posicao + 1);
} else {
	$quant = 1;
	$codigo = $codigop;
}//Fim quantidade e código


$produto = new Produto();


if(!ProdutoDao::existeCodigo($codigo)){
echo "<script>alert('Código inexistente.');window.location = 'index.php?pg=novavenda';</script>";
}else
	$produto = ProdutoDao::pesquisaProdutoCodigo($codigo);

if($produto -> getPreco() == 0){
	echo "<script>alert('ATENÇÃO o produto passado está sem preço. Atualize-o.');window.location = 'index.php?pg=novavenda';</script>";
}else{

	$produto->setQuantVenda($quant);

	if(!isset($_SESSION['produtos']))
	{
		$produto->setItemcompra(1);	
		$produtos = array();
		$produtos[0] = $produto;
		$_SESSION['produtos'] = $produtos;
		  
	}else{
		$produtos = unserialize($_SESSION['produtos']);
		
		$ultimo = sizeof($produtos);
		
		$item = count($produtos)+1;
		
		$produto->setItemcompra($item);
			
		$produtos[$ultimo] = $produto;
		
		$_SESSION['produtos'] = $produtos;
	}

	$produtosSerializados = serialize($_SESSION['produtos']);

	$_SESSION['produtos'] = $produtosSerializados;

	header("Location: index.php?pg=novavenda");
}


?>

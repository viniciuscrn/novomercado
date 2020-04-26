<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/bean/Produto.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/" . $_SESSION["nomeprojeto"] . "/dao/ProdutoDAO.php");

class VendaDAO {

    //Funcao Inserir venda se for a primeira do dia
    function novaVenda($total,$dia,$caixa) {

        $con = conectar();
        
        $stmt = $con->prepare("INSERT INTO venda (total,dia,usuario_idusuario) VALUES ( ? , ? , ?)");
        $stmt->bindParam(1, $total);
        $stmt->bindParam(2, $dia);
        $stmt->bindParam(3, $caixa);
           
        try {
            $exe = $stmt->execute();
            return true;
            if (! $exe)
                throw new Exception("Erro no cadastro");
        } catch (exception $e) {
            echo $e;
        }
    }

    //Funcao Inserir venda se for a primeira do dia
    function primeiraVenda($total,$dia) {

        $con = conectar();
        
        $stmt = $con->prepare("INSERT INTO venda (total,dia) VALUES ( ? , ? )");
        $stmt->bindParam(1, $total);
        $stmt->bindParam(2, $dia);
           
        try {
            $exe = $stmt->execute();
            return true;
            if (! $exe)
                throw new Exception("Erro no cadastro");
        } catch (exception $e) {
            echo $e;
        }
    }
	
	 //Funcao Atualizar venda se não for a primeira do dia
	function atualizaVenda($valor,$dia) {
       $con = conectar();
       $stmt = $con->prepare("UPDATE venda set total = total + :valor WHERE dia = :dia");
      	$stmt->execute(array(
    	':valor'   => $valor,
    	':dia' => $dia
  		));
	
    }
	
	//Função para saber se a venda é a primeira do dia
	
	function ehAprimeira($dia){
		$con = conectar();
        $query = $con->query("SELECT total FROM venda WHERE dia = '$dia'");
        
        $rows = $query->fetchall(PDO::FETCH_ASSOC);

		if (count($rows) > 0)
		 	$cont = FALSE;
		else $cont = TRUE; 			 
		
		return $cont;
	}
	
	//Função para atualizar o estoque
	
	function atualizaEstoque($quant,$id){
		$query = mysql_query("UPDATE produto SET quantestoque = quantestoque - '$quant' WHERE id = '$id'");
		if (!$query) {
            die('Erro na atualização de estoque: ' . mysql_error());
        }
	}
	
	
	//Função que retorna a soma das vendas em um dia
	
	function somaVendaDia($dia){
	
        $valor = 0; 
		$query = $con->query("SELECT total FROM venda WHERE dia = $dia");
		 
		while($resultado = $query->fetchall(PDO::FETCH_ASSOC)){
			$valor =+ $resultado["total"];
		} 

      return $valor; 
	}
	
	//Função que retorna o total de valores recebido em um mês
	
	function totalMes($mes,$ano){
		$query = mysql_query("SELECT sum(total) from venda WHERE MONTH(dia) = $mes and YEAR(dia) = $ano");
		if(mysql_num_rows($query)>0){
			$total = mysql_result($query,0);
		}else{
			echo "Nothing";
		}
		return $total;
	}
	
	//Função que retorna o total em valor em estoque
	function totalEstoque(){
		
		$total = 0;
		$query = mysql_query("SELECT sum(quantestoque * preco) ValorTotal from produto");
		 if(mysql_num_rows($query)>0){
			$total = mysql_result($query,0);
		}else{
			echo "Nothing";
		}
		return $total;

	}
	
	function totalProdutos(){
		
		$total = 0;
		$query = mysql_query("SELECT count(preco) from produto");
		 if(mysql_num_rows($query)>0){
			$total = mysql_result($query,0);
		}else{
			echo "Nothing";
		}
		return $total;

	}
	
	
	function obteveResultado($array){
		$np = count($array);
		
		if($np == 0){
			return true;
		}else{
			return false;
		}
		
	}

	//FUNCAO PARA INVERTER DATA PARA EN

	public static function inverteData($data){
        if (count(explode("/", $data)) > 1) {
            return implode("-", array_reverse(explode("/", $data)));
        } elseif (count(explode("-", $data)) > 1) {
            return implode("/", array_reverse(explode("-", $data)));
        }
    }

	//VENDAS DO USUÁRIO

	public static function calculavendascaixa($datainicio, $datafim, $idusuario){
		$con = conectar();
		
		$sql = "SELECT sum(total) FROM `venda` WHERE usuario_idusuario = $idusuario and dia BETWEEN $datainicio and $datafim";
		

		try {
			$stmte = $con->prepare("SELECT sum(total) FROM `venda` WHERE usuario_idusuario = ? and dia BETWEEN ? and ?");
			$stmte->bindParam(1, $idusuario , PDO::PARAM_INT);
			$stmte->bindParam(2, $datainicio , PDO::PARAM_INT);
			$stmte->bindParam(3, $datafim , PDO::PARAM_INT);
			$stmte->execute();
			$count = $stmte->fetchColumn();
			return $count;
		}catch(PDOException $e){
			setcookie("ErroPDO","Falha no Calculo de Produtos no carrinho - ".$e->getMessage());
			return false;
		}
		
	}


}

?>
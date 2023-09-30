<?php

class ProdutoDAO
{

    // Função para saber se existe algum produto cadastrado
    public static function existeProdutoCadastrado()
    {
        $con = conectar();
        $query = $con->query("SELECT id FROM produto")->fetchAll();
        if (count($query) > 0)
            return TRUE;
        else
            return FALSE;
    }

    // Função para saber se existe código de produto cadastrado
    public static function existeCodigo($codigo)
    {
        $con = conectar();
        $query = $con->query("SELECT id FROM produto WHERE codigo = $codigo")->fetchAll();
        if (count($query) > 0)
            return TRUE;
        else
            return FALSE;
    }

     // Função para saber se existe descrição de produto cadastrado
    public static function existeDescricao($descricao)
    {
        $con = conectar();
        $query = $con->query("SELECT id FROM produto WHERE descricao like '%$descricao%'")->fetchAll();
        if (count($query) > 0)
            return TRUE;
        else
            return FALSE;
    }


    // Metodo para cadastrar um novo produto
    public static function cadastroProduto($produto)
    {
        $codigo = $produto->getCodigo();
        $descricao = $produto->getDescricao();
        $quantestoque = $produto->getQuantestoque();
        $preco = $produto->getPreco();
        
        $con = conectar();
        
        $stmt = $con->prepare("INSERT INTO produto (codigo,descricao,quantestoque,preco) VALUES ( ? , ? , ? , ?)");
        $stmt->bindParam(1, $codigo);
        $stmt->bindParam(2, $descricao);
        $stmt->bindParam(3, $quantestoque);
        $stmt->bindParam(4, $preco);
        
        try {
            $exe = $stmt->execute();
            return true;
            if (! $exe)
                throw new Exception("Erro no cadastro");
        } catch (exception $e) {
            echo $e;
        }
    }

    // Metodo para pesquisar um objeto produto por seu id.
    public static function listaProdutos()
    {
        $con = conectar();
        $query = $con->query("SELECT id,codigo,descricao,quantestoque,preco FROM produto");
        $produtos = array();
        $cont = 0;
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            $produto = new Produto();
            $produto->setId($row->id);
            $produto->setCodigo($row->codigo);
            $produto->setDescricao($row->descricao);
            $produto->setQuantestoque($row->quantestoque);
            $produto->setPreco($row->preco);
            $produtos[$cont] = $produto;
            $cont ++;
        }
        return $produtos;
    }    
    // Metodo para pesquisar um objeto produto por seu id.
    public static function pesquisaProdutoId($id)
    {
        $con = conectar();
        
        $rs = $con->query("SELECT id,codigo,descricao,quantestoque,preco FROM produto WHERE id = $id");
        
        $row = $rs->fetch(PDO::FETCH_OBJ);
        
        $produto = new Produto();
        
        $produto->setid($row->id);
        $produto->setCodigo($row->codigo);
        $produto->setDescricao($row->descricao);
        $produto->setQuantestoque($row->quantestoque);
        $produto->setPreco($row->preco);
        
        return $produto;
    }    

    // Metodo para pesquisar um objeto produto por seu Codigo.
    public static function pesquisaProdutoCodigo($codigo)
    {
        $con = conectar();
        
        $rs = $con->query("SELECT id,codigo,descricao,quantestoque,preco FROM produto WHERE codigo = $codigo");
        
        $row = $rs->fetch(PDO::FETCH_OBJ);
        
        $produto = new Produto();
        
        $produto->setid($row->id);
        $produto->setCodigo($row->codigo);
        $produto->setDescricao($row->descricao);
        $produto->setQuantestoque($row->quantestoque);
        $produto->setPreco($row->preco);
        
        return $produto;
    }

    // FunÃ§Ã£o para retornar todos os produtos cadastrados.
    public static function pesquisaProdutoDescricao($codigo)
    {
        $con = conectar();
        $query = $con->query("SELECT id,codigo,descricao,quantestoque,preco FROM produto WHERE descricao like '%$codigo%'");
        $produtos = array();
        $cont = 0;
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            $produto = new Produto();
            $produto->setId($row->id);
            $produto->setCodigo($row->codigo);
            $produto->setDescricao($row->descricao);
            $produto->setQuantestoque($row->quantestoque);
            $produto->setPreco($row->preco);
            $produtos[$cont] = $produto;
            $cont ++;
        }
        return $produtos;
    }

    // Função para editar produto
    public static function editaProduto($produto)
    {
        $id = $produto->getid();
        $codigo = $produto->getCodigo();
        $descricao = $produto->getDescricao();
        $quantestoque = $produto->getQuantestoque();
        $preco = $produto->getPreco();
        $con = conectar();
        $stmt = $con->prepare("UPDATE produto set codigo = :codigo, descricao = :descricao, quantestoque = :quantestoque, preco = :preco WHERE id = $id");
        $stmt->bindValue(":codigo", $codigo);
        $stmt->bindValue(":descricao", $descricao);
        $stmt->bindValue(":quantestoque", $quantestoque);
        $stmt->bindValue(":preco", $preco);
        try {
            $exe = $stmt->execute();
            return true;
            if (! $exe)
                throw new Exception("Erro na Atualização do produto");
        } catch (exception $e) {
            echo $e;
        }
    }
}

?>
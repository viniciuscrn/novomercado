<?php
class ClienteDAO
{

    //Metodo para cadastrar um novo cliente
    public function cadastroCliente($cliente)
    {
        $nome = $cliente->getNome();
        $telefone = $cliente->getTelefone();
        $rua = $cliente->getRua();
        $bairro = $cliente->getBairro();
        $cidade = $cliente->getCidade();
        $estado = $cliente->getEstado();
        $data = $cliente->getData();
        $obs = $cliente->getObs();
        $debito = $cliente->getDebito();
        $credito = $cliente->getCredito();
        $saldo = $cliente->getSaldo();

        $con = conectar();

        $stmt = $con->prepare("INSERT INTO cliente (nome,telefone,rua,bairro,cidade,estado,data,obs,saldo) VALUES ( ? , ? , ? , ? , ? , ? , ? , ? , ? )");
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $telefone);
        $stmt->bindParam(3, $rua);
        $stmt->bindParam(4, $bairro);
        $stmt->bindParam(5, $cidade);
        $stmt->bindParam(6, $estado);
        $stmt->bindParam(7, $data);
        $stmt->bindParam(8, $obs);
        $stmt->bindParam(9, $saldo);

        try {
            $exe = $stmt->execute();
            return true;
            if (!$exe)
                throw new Exception("Erro no cadastro");
        } catch (exception $e) {
            echo $e;
        }
    }
    //Metodo para pesquisar um objeto cliente por seu id.
    public function pesquisaClienteId($id)
    {

        $con = conectar();

        $rs = $con->query("SELECT id,nome,telefone,rua,bairro,cidade,estado,data,obs,saldo FROM cliente WHERE id = $id");

        $row = $rs->fetch(PDO::FETCH_OBJ);

        $cliente = new Cliente();

        $cliente->setId($row->id);
        $cliente->setNome($row->nome);
        $cliente->setTelefone($row->telefone);
        $cliente->setRua($row->rua);
        $cliente->setBairro($row->bairro);
        $cliente->setCidade($row->cidade);
        $cliente->setEstado($row->estado);
        $cliente->setData($row->data);
        $cliente->setObs($row->obs);
        $cliente->setSaldo($row->saldo);

        return $cliente;
    }
    //Função para retornar todos os clientes cadastrados.
    public function listaClientes()
    {

        $con = conectar();
        $query = $con->query("SELECT id,nome,telefone,rua,bairro,cidade,estado,data,obs,saldo FROM cliente");
        $clientes = array();
        $cont = 0;
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            $cliente = new Cliente();
            $cliente->setId($row->id);
            $cliente->setNome($row->nome);
            $cliente->setTelefone($row->telefone);
            $cliente->setRua($row->rua);
            $cliente->setBairro($row->bairro);
            $cliente->setCidade($row->cidade);
            $cliente->setEstado($row->estado);
            $cliente->setData($row->data);
            $cliente->setObs($row->obs);
            $cliente->setSaldo($row->saldo);
            $clientes[$cont] = $cliente;
            $cont++;
        }
        return $clientes;
    }
    //FUnção para editar cliente
    public function editaCliente($cliente)
    {
        $id = $cliente->getId();
        $nome = $cliente->getNome();
        $telefone = $cliente->getTelefone();
        $rua = $cliente->getRua();
        $bairro = $cliente->getBairro();
        $cidade = $cliente->getCidade();
        $estado = $cliente->getEstado();
        $data = $cliente->getData();
        $obs = $cliente->getObs();
        $saldo = $cliente->getSaldo();
        $con = conectar();
        $stmt = $con->prepare("UPDATE cliente set nome = :nome, telefone = :telefone, rua = :rua, bairro = :bairro, cidade = :cidade, estado = :estado, data = :data, obs = :obs, saldo = :saldo WHERE id = $id");
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":telefone", $telefone);
        $stmt->bindValue(":rua", $rua);
        $stmt->bindValue(":bairro", $bairro);
        $stmt->bindValue(":cidade", $cidade);
        $stmt->bindValue(":estado", $estado);
        $stmt->bindValue(":data", $data);
        $stmt->bindValue(":obs", $obs);
        $stmt->bindValue(":saldo", $saldo);
        try {
            $exe = $stmt->execute();
            if (!$exe)
                throw new Exception("Erro na Atualização do cliente");
        } catch (exception $e) {
            echo $e;
        }
    }

     //FUnção para editar cliente
     public static function pagamento($id,$credito,$debito)
     {
         $con = conectar();
         $stmt = $con->prepare("UPDATE cliente set saldo = saldo + $credito - $debito WHERE id = $id");
         try {
             $exe = $stmt->execute();
             if (!$exe)
                 throw new Exception("Erro na Atualização do cliente");
         } catch (exception $e) {
             echo $e;
         }
     }

     public static function moeda($num){
        $num = str_replace(".", "", "$num");
        $num = str_replace(",", ".", "$num");
        return $num;
    }
}

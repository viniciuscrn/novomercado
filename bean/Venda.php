<?php
class Venda{ 

private $idvenda; 
private $hora; 
private $data; 
private $valortotal; 
private $valorrecebido; 
private $encerrada; 
private $cliente_idcliente; 
private $usuario_idusuario; 

function __construct() {}

public function getIdvenda(){
return $this -> idvenda;
} 

public function setIdvenda($idvenda){
$this -> idvenda = $idvenda;
} 

public function getHora(){
return $this -> hora;
} 

public function setHora($hora){
$this -> hora = $hora;
} 

public function getData(){
return $this -> data;
} 

public function setData($data){
$this -> data = $data;
} 

public function getValortotal(){
return $this -> valortotal;
} 

public function setValortotal($valortotal){
$this -> valortotal = $valortotal;
} 

public function getValorrecebido(){
return $this -> valorrecebido;
} 

public function setValorrecebido($valorrecebido){
$this -> valorrecebido = $valorrecebido;
} 

public function getEncerrada(){
return $this -> encerrada;
} 

public function setEncerrada($encerrada){
$this -> encerrada = $encerrada;
} 

public function getCliente_idcliente(){
return $this -> cliente_idcliente;
} 

public function setCliente_idcliente($cliente_idcliente){
$this -> cliente_idcliente = $cliente_idcliente;
} 

public function getUsuario_idusuario(){
return $this -> usuario_idusuario;
} 

public function setUsuario_idusuario($usuario_idusuario){
$this -> usuario_idusuario = $usuario_idusuario;
} 

}

?>
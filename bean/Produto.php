<?php
class Produto{ 

private $id; 
private $codigo; 
private $descricao; 
private $quantestoque; 
private $preco; 
private $quantvenda; 
private $itemcompra;


function __construct() {}

public function getId(){
return $this -> id;
} 

public function setId($id){
$this -> id = $id;
} 

public function getCodigo(){
return $this -> codigo;
} 

public function setCodigo($codigo){
$this -> codigo = $codigo;
} 

public function getDescricao(){
return $this -> descricao;
} 

public function setDescricao($descricao){
$this -> descricao = $descricao;
} 

public function getQuantestoque(){
return $this -> quantestoque;
} 

public function setQuantestoque($quantestoque){
$this -> quantestoque = $quantestoque;
} 

public function getPreco(){
return $this -> preco;
} 

public function setPreco($preco){
$this -> preco = $preco;
} 

public function getQuantvenda(){
return $this -> quantvenda;
} 

public function setQuantvenda($quantvenda){
$this -> quantvenda = $quantvenda;
} 

public function getItemcompra(){
return $this -> itemcompra;
} 

public function setItemcompra($itemcompra){
$this -> itemcompra = $itemcompra;
} 

}
?>
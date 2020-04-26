<?php 
$id = isset($_POST['id']) ? $_POST['id'] : '';

$con = conectar();
        
$rs = $con->query("SELECT id,codigo,descricao,quantestoque,preco FROM produto WHERE id = $id");
        
echo json_encode($rs->fetch(PDO::FETCH_OBJ));
   
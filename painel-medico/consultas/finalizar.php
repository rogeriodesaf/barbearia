<?php 

require_once("../../conexao.php");
$id = $_POST['id'];




$res = $pdo->query("UPDATE consultas set status = 'Finalizada' where id = '$id' ");


$res->execute();


echo "Editado com Sucesso!!";





?>
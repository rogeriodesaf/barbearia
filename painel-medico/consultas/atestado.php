<?php 

require_once("../../conexao.php");
$id = $_POST['id'];
$dias = $_POST['dias'];



$res = $pdo->query("UPDATE consultas set atestado = '$dias' where id = '$id' ");


echo "Editado com Sucesso!!";





?>
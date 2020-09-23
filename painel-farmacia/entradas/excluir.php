<?php 

require_once("../../conexao.php");

$id = $_POST['id'];


//BUSCAR A QUANTIDADE DE ENTRADA EXCLUIDA
	$res_ent = $pdo->query("select * from entradas_remedios where id = '$id'");
	$dados_ent = $res_ent->fetchAll(PDO::FETCH_ASSOC);
	
	$quant_ent = $dados_ent[0]['quantidade'];
	$id_remedio = $dados_ent[0]['remedio'];


//BUSCAR O ESTOQUE DO REMÉDIO
	$res_remedio = $pdo->query("select * from remedios where id = '$id_remedio'");
	$dados_remedio = $res_remedio->fetchAll(PDO::FETCH_ASSOC);
	
	$quant_remedio = $dados_remedio[0]['estoque'];


$res = $pdo->prepare("DELETE from entradas_remedios where id = :id ");

$res->bindValue(":id", $id);

$res->execute();



//ATUALIZAR ESTOQUE
$quantidade_total = $quant_remedio - $quant_ent;

	$res = $pdo->query("UPDATE remedios set estoque = '$quantidade_total' where id = '$id_remedio' ");



	echo "Cadastrado com Sucesso!!";

?>
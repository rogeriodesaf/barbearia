<?php 

require_once("../../conexao.php");

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$remedios = $_POST['remedios'];


$id = $_POST['id'];
$campo_antigo = $_POST['campo_antigo'];



if($campo_antigo != $telefone){

		//VERIFICAR SE O MÉDICO JÁ ESTÁ CADASTRADO
	$res_c = $pdo->query("select * from fornecedores where telefone = '$telefone'");
	$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_c);

	if($linhas != 0){

		echo "Já cadastrado!!";
		exit();
	}

}





$res = $pdo->prepare("UPDATE fornecedores set nome = :nome, telefone = :telefone, email = :email, remedios = :remedios where id = :id ");

$res->bindValue(":nome", $nome);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":email", $email);
$res->bindValue(":remedios", $remedios);

$res->bindValue(":id", $id);

$res->execute();


echo "Editado com Sucesso!!";





?>
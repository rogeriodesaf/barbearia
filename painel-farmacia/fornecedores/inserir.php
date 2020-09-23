<?php 

require_once("../../conexao.php");

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$remedios = $_POST['remedios'];

	//VERIFICAR SE O REGISTRO JÁ ESTÁ CADASTRADO
$res_c = $pdo->query("select * from fornecedores where telefone = '$telefone'");
$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_c);


if($nome == ''){
	echo "Preencha o Nome!!";
	exit();
}

if($telefone == ''){
	echo "Preencha o Telefone!!";
	exit();
}

if($linhas == 0){
	$res = $pdo->prepare("INSERT into fornecedores (nome, telefone, email, remedios) values (:nome, :telefone, :email, :remedios)");

	$res->bindValue(":nome", $nome);
	$res->bindValue(":telefone", $telefone);
	$res->bindValue(":email", $email);
	$res->bindValue(":remedios", $remedios);
	

	$res->execute();




	echo "Cadastrado com Sucesso!!";

}else{
	echo "Registro já cadastrado!!";
}



?>
<?php 

require_once("../../conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];


	//VERIFICAR SE O REMEDIO JÁ ESTÁ CADASTRADO
$res_c = $pdo->query("select * from remedios where nome = '$nome'");
$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_c);


if($nome == ''){
	echo "Preencha o Nome!!";
	exit();
}

if($descricao == ''){
	echo "Preencha a Descrição!!";
	exit();
}

if($linhas == 0){
	$res = $pdo->prepare("INSERT into remedios (nome, descricao) values (:nome, :descricao)");

	$res->bindValue(":nome", $nome);
	$res->bindValue(":descricao", $descricao);
	
	

	$res->execute();




	echo "Cadastrado com Sucesso!!";

}else{
	echo "Paciente já cadastrado!!";
}



?>
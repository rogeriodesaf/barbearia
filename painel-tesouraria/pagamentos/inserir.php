<?php 

require_once("../../conexao.php");
@session_start();

$cargo = $_POST['cargo'];
$funcionario = $_POST['funcionario'];
$valor = $_POST['valor'];
$valor = str_replace(',', '.', $valor);


$email_usuario = $_SESSION['email_usuario'];

//BUSCAR O CPF DO USUÁRIO LOGADO (NESSE CASO UM TESOUREIRO)
$res_excluir = $pdo->query("select * from tesoureiros where email = '$email_usuario'");
$dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
$func= $dados_excluir[0]['cpf'];


//BUSCAR O NOME DO FUNCIONÁRIO)
$res = $pdo->query("select * from funcionarios where cpf = '$funcionario'");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$nome_funcionario= $dados[0]['nome'];



if($funcionario == ''){
	echo "Escolha um Funcionário!!";
	exit();
}

if($valor == ''){
	echo "Preencha o Valor!";
	exit();
}


	$res = $pdo->prepare("INSERT into pagamentos (funcionario, valor, tesoureiro, data, nome_funcionario) values (:funcionario, :valor, :tesoureiro, curDate(), :nome_funcionario)");

	$res->bindValue(":funcionario", $funcionario);
	$res->bindValue(":valor", $valor);

	$res->bindValue(":tesoureiro", $func);
	$res->bindValue(":nome_funcionario", $nome_funcionario);

	$res->execute();





//LANÇAR NA TABELA DE MOVIMENTAÇÕES

//TRAZER O ULTIMO ID QUE FOI SALVO EM CONTAS A PAGAR
$res_valor = $pdo->query("select * from pagamentos order by id desc limit 1");
$dados_valor  = $res_valor ->fetchAll(PDO::FETCH_ASSOC);
$id_pgto = $dados_valor [0]['id'];

$res = $pdo->prepare("INSERT into movimentacoes (tipo, movimento, valor, tesoureiro, data, id_movimento) values (:tipo, :movimento, :valor, :tesoureiro, curDate(), :id_movimento)");

$res->bindValue(":tipo", 'Saída');
$res->bindValue(":movimento", 'Pgto Funcionário');
$res->bindValue(":valor", $valor);
$res->bindValue(":tesoureiro", $func);
$res->bindValue(":id_movimento", $id_pgto);

$res->execute();



	

	echo "Cadastrado com Sucesso!!";



?>
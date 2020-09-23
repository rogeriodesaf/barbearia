<?php 

require_once("../../conexao.php");
@session_start();
$remedio = $_POST['remedio'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];
$fornecedor = $_POST['fornecedor'];

$valor = str_replace(',', '.', $valor);

$valor_total = $quantidade * $valor;
$agora = date('Y-m-d');

//BUSCAR O NOME DO REMÉDIO
	$res_remedio = $pdo->query("select * from remedios where id = '$remedio'");
	$dados_remedio = $res_remedio->fetchAll(PDO::FETCH_ASSOC);
	$nome_remedio= $dados_remedio[0]['nome'];
	$quant_remedio = $dados_remedio[0]['estoque'];


$email_usuario = $_SESSION['email_usuario'];

//BUSCAR O CPF DO USUÁRIO LOGADO (NESSE CASO UM TESOUREIRO)
$res_excluir = $pdo->query("select * from funcionarios where email = '$email_usuario'");
$dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
$func= $dados_excluir[0]['cpf'];




if($remedio == ''){
	echo "Selecione um Remédio!!";
	exit();
}




	$res = $pdo->prepare("INSERT into entradas_remedios (remedio, quantidade, valor, fornecedor, farmaceutico, nome_remedio, data) values (:remedio, :quantidade, :valor, :fornecedor, :farmaceutico, :nome_remedio, curDate())");

	$res->bindValue(":remedio", $remedio);
	$res->bindValue(":quantidade", $quantidade);
	$res->bindValue(":valor", $valor);
	$res->bindValue(":fornecedor", $fornecedor);
	$res->bindValue(":farmaceutico", $func);
	$res->bindValue(":nome_remedio", $nome_remedio);
	

	$res->execute();




	//TRAZER O TOTAL DE ESTOQUE DO REMÉDIO INSERIDO PARA PODER ADICIONAR A QUANTIDADE COMPRADA

	$quantidade_total = $quant_remedio + $quantidade;

	$res = $pdo->query("UPDATE remedios set estoque = '$quantidade_total' where id = '$remedio' ");




	//LANÇAR VALOR PARA O PAGAMENTO EM CONTAS A PAGAR
	$res = $pdo->prepare("INSERT into contas_pagar (descricao, valor, vencimento, pago, funcionario, foto) values (:descricao, :valor, :vencimento, :pago, :funcionario, :foto)");

	$res->bindValue(":descricao", 'Compra de Remédios');
	$res->bindValue(":valor", $valor_total);
	$res->bindValue(":vencimento", $agora);
	$res->bindValue(":pago", 'Não');
	$res->bindValue(":funcionario", $func);
	$res->bindValue(":foto", 'sem-foto.png');

	$res->execute();

	echo "Cadastrado com Sucesso!!";




?>
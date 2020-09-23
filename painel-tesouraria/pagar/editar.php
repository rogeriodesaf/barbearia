<?php 

require_once("../../conexao.php");
@session_start();

$id = $_POST['id'];

$email_usuario = $_SESSION['email_usuario'];

//BUSCAR O CPF DO USUÁRIO LOGADO (NESSE CASO UM TESOUREIRO)
$res_excluir = $pdo->query("select * from tesoureiros where email = '$email_usuario'");
$dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
$func= $dados_excluir[0]['cpf'];

$pdo->query("UPDATE contas_pagar set pagamento = curDate(), pago = 'Sim', funcionario = '$func'  where id = '$id' ");


echo "Editado com Sucesso!!";





//LANÇAR NA TABELA DE MOVIMENTAÇÕES

//BUSCAR O VALOR DA CONSULTA FEITA
$res_valor = $pdo->query("select * from contas_pagar where id = '$id'");
$dados_valor  = $res_valor ->fetchAll(PDO::FETCH_ASSOC);
$valor = $dados_valor [0]['valor'];

$res = $pdo->prepare("INSERT into movimentacoes (tipo, movimento, valor, tesoureiro, data, id_movimento) values (:tipo, :movimento, :valor, :tesoureiro, curDate(), :id_movimento)");

$res->bindValue(":tipo", 'Saída');
$res->bindValue(":movimento", 'Pagamento Conta');
$res->bindValue(":valor", $valor);
$res->bindValue(":tesoureiro", $func);
$res->bindValue(":id_movimento", $id);

$res->execute();



?>
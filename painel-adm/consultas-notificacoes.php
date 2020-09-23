<?php

$res_1 = $pdo->query("SELECT * from remedios where estoque <= '$nivel_estoque'");
$dados_1 = $res_1->fetchAll(PDO::FETCH_ASSOC);
$valor_1 = count($dados_1);
if ($valor_1 > 0) {
    @$item_1 = 1;
}

$res_2 = $pdo->query("SELECT * from contas_receber where vencimento = curDate() and tipo_pgto is null");
$dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);
$valor_2 = count($dados_2);
if ($valor_2 > 0) {
    @$item_2 = 1;
}

$res_3 = $pdo->query("SELECT * from contas_pagar where vencimento = curDate() and pago != 'sim'");
$dados_3 = $res_3->fetchAll(PDO::FETCH_ASSOC);
$valor_3 = count($dados_3);
if ($valor_3 > 0) {
    @$item_3 = 1;
}

$res_4 = $pdo->query("SELECT * from consultas where data = curDate() and hora < curTime() and status = 'Aguardando'");
$dados_4 = $res_4->fetchAll(PDO::FETCH_ASSOC);
$valor_4 = count($dados_4);
if ($valor_4 > 0) {
    $item_4 = 1;
}

$total_notificacoes = @$item_1+@$item_2+@$item_3+@$item_4;
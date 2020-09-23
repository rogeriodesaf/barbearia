<?php 

require_once("../../conexao.php");
$id = $_POST['id'];




$res = $pdo->query("UPDATE consultas set status = 'Consultando' where id = '$id' ");



//BUSCAR NA CONSULTA O ID DO PACIENTE E O ID DO MÉDICO
$res_con = $pdo->query("SELECT * from consultas where id = '$id'");
	$dados_con = $res_con->fetchAll(PDO::FETCH_ASSOC);
	$linhas_con = count($dados_con);

	if($linhas_con > 0){

		$paciente = $dados_con[0]['paciente'];	
		$medico = $dados_con[0]['medico'];	

	}


//BUSCAR O NOME DO PACIENTE
$res_valor = $pdo->query("SELECT * from pacientes where id = '$paciente'");
	$dados_valor = $res_valor->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_valor);

	if($linhas > 0){

		$nome_paciente = $dados_valor[0]['nome'];	

	}



//BUSCAR O NOME DO PACIENTE
$res_med = $pdo->query("SELECT * from medicos where id = '$medico'");
	$dados_med = $res_med->fetchAll(PDO::FETCH_ASSOC);
	$linhas_med = count($dados_med);

	if($linhas_med > 0){

		$consultorio = $dados_med[0]['consultorio'];	

	}


//ATUALIZAR A TABELA DE CHAMADAS
$res = $pdo->query("UPDATE chamadas set paciente = '$nome_paciente', consultorio = '$consultorio', status = 'Chamando' where id = 1 ");


echo "Editado com Sucesso!!";





?>
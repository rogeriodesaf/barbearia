<?php 
@session_start();
require_once("../../conexao.php");
$pagina = 'prescricoes';

$txtbuscar = @$_POST['txtbuscar'];


echo '
<table class="table mt-3">
<thead class="thead-light">
<tr>
<th scope="col">Paciente</th>
<th scope="col">Médico</th>
<th scope="col">Hora</th>
<th scope="col">Atendimento</th>
<th scope="col">Prescrição</th>
</tr>
</thead>
<tbody>';




if($txtbuscar == ''){
	$res = $pdo->query("SELECT * from consultas where data = curDate() and prescricao = 'sim' order by hora asc LIMIT $limite, $itens_por_pagina");
}else{
	$txtbuscar = @$_POST['txtbuscar'];
	$res = $pdo->query("SELECT * from consultas where data = '$txtbuscar' and prescricao = 'sim' order by hora asc");

}

$dados = $res->fetchAll(PDO::FETCH_ASSOC);


	


for ($i=0; $i < count($dados); $i++) { 
	foreach ($dados[$i] as $key => $value) {
	}

	$id = $dados[$i]['id'];	
	$paciente = $dados[$i]['paciente'];
	$hora = $dados[$i]['hora'];
	$tipo_atendimento = $dados[$i]['tipo_atendimento'];
	$medico = $dados[$i]['medico'];
	$status = $dados[$i]['status'];
	$atestado = $dados[$i]['atestado'];

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

		$nome_medico = $dados_med[0]['nome'];	

	}


	

	//BUSCAR O TIPO DE ATENDIMENTO
	$res_med = $pdo->query("SELECT * from atendimentos where id = '$tipo_atendimento'");
	$dados_med = $res_med->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_med);

	if($linhas > 0){

		$atendimento = $dados_med[0]['descricao'];	

	}


	echo '
	<tr>


	<td>'.$nome_paciente.'</td>
	<td>'.$nome_medico.'</td>
	<td>'.$hora.'</td>
	<td>'.$atendimento.'</td>
	
	<td>
	<big>

	
	<a target="_blank" href="rel/rel_prescricao_class.php?id='.$id.'"><i class="fas fa-file-powerpoint text-info" title="Gerar Prescrição"></i></a> 

	</big></td>
	';

	

	

}

echo  '
</tbody>
</table> ';




?>
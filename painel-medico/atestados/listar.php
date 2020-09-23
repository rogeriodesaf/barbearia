<?php 
@session_start();
require_once("../../conexao.php");
$pagina = 'atestados';

$txtbuscar = @$_POST['txtbuscar'];


echo '
<table class="table mt-3">
<thead class="thead-light">
<tr>
<th scope="col">Paciente</th>
<th scope="col">Hora</th>
<th scope="col">Atendimento</th>
<th scope="col">Atestado</th>
</tr>
</thead>
<tbody>';


$email_medico = $_SESSION['email_usuario'];


	$res_espec = $pdo->query("SELECT * from medicos where email = '$email_medico'");
							$dados_espec = $res_espec->fetchAll(PDO::FETCH_ASSOC);

							for ($i=0; $i < count($dados_espec); $i++) { 
								foreach ($dados_espec[$i] as $key => $value) {
								}

								$id_medico = $dados_espec[$i]['id'];	
								$consultorio = $dados_espec[$i]['consultorio'];
								$nome_medico = $dados_espec[$i]['nome'];


}


if($txtbuscar == ''){
	$res = $pdo->query("SELECT * from consultas where data = curDate() and medico = '$id_medico' and atestado != '' order by hora asc LIMIT $limite, $itens_por_pagina");
}else{
	$txtbuscar = @$_POST['txtbuscar'];
	$res = $pdo->query("SELECT * from consultas where data = '$txtbuscar' and medico = '$id_medico' and atestado != '' order by hora asc");

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
	<td>'.$hora.'</td>
	<td>'.$atendimento.'</td>
	
	<td>
	<big>

	
	<a target="_blank" href="rel/rel_atestado_class.php?id='.$id.'"><i class="fas fa-file-medical text-info" title="Gerar Atestado"></i></a> 

	</big></td>
	';

	

	

}

echo  '
</tbody>
</table> ';




?>
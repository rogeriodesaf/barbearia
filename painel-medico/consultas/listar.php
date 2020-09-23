<?php 
@session_start();
require_once("../../conexao.php");
$pagina = 'consultas';

$txtbuscar = @$_POST['txtbuscar'];


echo '
<table class="table mt-3">
<thead class="thead-light">
<tr>
<th scope="col">Paciente</th>
<th scope="col">Hora</th>
<th scope="col">Atendimento</th>
<th scope="col">Status</th>
<th scope="col">Relatórios</th>
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
	$res = $pdo->query("SELECT * from consultas where data = curDate() and medico = '$id_medico' and pgto_confirmado = 'Sim' order by hora asc LIMIT $limite, $itens_por_pagina");
}else{
	$txtbuscar = @$_POST['txtbuscar'];
	$res = $pdo->query("SELECT * from consultas where data = '$txtbuscar' and medico = '$id_medico' and pgto_confirmado = 'Sim' order by hora asc");

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


	<td><a class="text-dark" href="index.php?acao='.$pagina.'&funcao=editar&id='.$paciente.'">'.$nome_paciente.'</a></td>
	<td>'.$hora.'</td>
	<td>'.$atendimento.'</td>
	
	<td>';

	if($status != 'Finalizada'){
		echo '
	<a href="index.php?acao='.$pagina.'&funcao=consultando&id='.$id.'"><i class="fas fa-user-check text-info" title="Status Consultando"></i></a>
	<a href="index.php?acao='.$pagina.'&funcao=finalizar&id='.$id.'"><i class="fas fa-check-circle text-success" title="Concluir Consulta"></i></a>
	
	';
	}else{
		echo '
		<span class="text-danger">Finalizada</span></td>';
	}

	echo '
	<td>


	<big>';

	if($atestado == null){
		echo '<a href="index.php?acao='.$pagina.'&funcao=atestado&id='.$id.'"><i class="fas fa-file-medical text-warning" title="Gerar Atestado"></i></a>';
	}

	
	echo '
	<a href="index.php?acao='.$pagina.'&funcao=receita&id='.$id.'"><i class="fas fa-file-medical-alt text-info" title="Gerar Receita"></i></a>

	<a href="index.php?acao='.$pagina.'&funcao=prescricao&id='.$id.'"><i class="fas fa-file-powerpoint text-secondary" title="Gerar Prescrição"></i></a>

	</big>
	</td>
	</tr>
	';

	

}

echo  '
</tbody>
</table> ';




?>
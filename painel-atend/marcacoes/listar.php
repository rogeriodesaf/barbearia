<?php 

require_once("../../conexao.php");
$pagina = 'marcacoes';

$txtbuscar = @$_POST['txtbuscar'];
$cbmedicos = @$_POST['cbmedicos'];

if($txtbuscar == ''){
	$txtbuscar = date('Y-m-d');

}


if($cbmedicos == ''){
	$res = $pdo->query("SELECT * from medicos order by nome asc");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados);
	if($linhas > 0){
	$cbmedicos = $dados[0]['id'];;
	}

}


$classebtn = 'btn-success';

echo '
<div class="quadro">';

for($i=8;$i<20;$i++){

	$hora_testada = $i.':00';

	//CONSULTAR NO BANCO DE DADOS SE O HORÁRIO ESTÁ DISPONÍVEL
	$res_valor = $pdo->query("SELECT * from consultas where data = '$txtbuscar' and medico = '$cbmedicos' and hora = '$hora_testada'");
	$dados_valor = $res_valor->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_valor);

	if($linhas > 0){

		$classebtn = 'btn-danger';
		$disabled = 'disabled';

	}else{
		$classebtn = 'btn-success';
		$disabled = '';
	}

	echo '<button class="btn '.$classebtn.' mr-2 mb-2" id="btn-hora" '.$disabled.' onclick="hora('.$i.')">'.$i.':00</button>';

}

echo '
</div>
';




?>



<script >
	function hora(h) {
		document.getElementById('hora').value = h + ':00';

		var id_pac = document.getElementById("txtidpac").value;
			var id = document.getElementById("id").value;
			var data = document.getElementById("txtbuscar").value;
			var medico = document.getElementById("cbmedicos").value;


			document.getElementById('data').value = data;
			document.getElementById('medico').value = medico;

			if(id_pac == ''){
				document.getElementById('txtid').value = id;
			}else{
				document.getElementById('txtid').value = id_pac;
			}
			



			if (id == '' && id_pac == ''){
				alert('Escolha o Paciente');
			}else{
				$("#modal").modal("show");
				document.getElementById("mensagem").style.display = "none";
			}
		
	}
</script>





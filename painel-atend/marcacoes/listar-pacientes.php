<?php 

require_once("../../conexao.php");
$pagina = 'marcacoes';

$txtbuscar = @$_POST['txtbuscar-paciente'];


if ($txtbuscar != ''){

echo '
<table class="table table-sm" width="250px">
	<thead class="thead-light">
		<tr>
			<th scope="col">Nome</th>
			<th scope="col">CPF</th>
			
			
			<th scope="col">Ações</th>
		</tr>
	</thead>
	<tbody>';

	
	    

	
	$txtbuscar = '%'.@$_POST['txtbuscar-paciente'].'%';
	$res = $pdo->query("SELECT * from pacientes where cpf LIKE '$txtbuscar' order by id desc limit 1");

	
	
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);

	for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {
			}

			$id = $dados[$i]['id'];	
			$nome = $dados[$i]['nome'];
			$cpf = $dados[$i]['cpf'];
			$telefone = $dados[$i]['telefone'];
			$idade = $dados[$i]['idade'];
			
			


echo '
		<tr>

			
			<td>'.$nome.'</td>
			<td>'.$cpf.'</td>
			<td><a id="btn-selecionar"><i class="fas fa-check-circle text-success"></i></a></td>
			
			
		</tr>';

	}

echo  '
	</tbody>
</table> ';


}



?>





<script type="text/javascript">
	$(document).ready(function(){
	
		$('#btn-selecionar').click(function(event){
			event.preventDefault();
			
			var id = "<?=$id?>";
			var nome = "<?=$nome?>";

			document.getElementById('txtbuscar-paciente').value = nome;
			document.getElementById('id').value = id;

			document.getElementById("listar-paciente").style.display = "none";
			//document.getElementById('txtbuscar-paciente').value = '';


		})
	})
</script>

<?php 

require_once("../../conexao.php");

$pagina = 'nivel';

$txtbuscar = @$_POST['txtbuscar'];


echo '
<table class="table table-sm mt-3 tabelas">
	<thead class="thead-light">
		<tr>
			<th scope="col">Nome</th>
			<th scope="col">Descrição</th>
			<th scope="col">Estoque</th>
			
			
			
		</tr>
	</thead>
	<tbody>';

	

	
	$res = $pdo->query("SELECT * from remedios where estoque <= '$nivel_estoque' order by estoque asc");

	
	
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);

	for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {
			}

			$id = $dados[$i]['id'];	
			$nome = $dados[$i]['nome'];
			$descricao = $dados[$i]['descricao'];
			$estoque = $dados[$i]['estoque'];
			


echo '
		<tr>

			
			<td>'.$nome.'</td>
			<td>'.$descricao.'</td>
			<td>'.$estoque.'</td>
		
			
		
		</tr>';

	}

echo  '
	</tbody>
</table> ';




?>
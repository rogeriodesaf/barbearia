<?php 

require_once("../../conexao.php");
@session_start();
$pagina = 'entradas';

$txtbuscar = @$_POST['txtbuscar'];
$data = @$_POST['data'];



$email_usuario = $_SESSION['email_usuario'];

//BUSCAR O CPF DO USUÁRIO LOGADO (NESSE CASO UM TESOUREIRO)
$res_excluir = $pdo->query("select * from funcionarios where email = '$email_usuario'");
$dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
$cpf_usuario= $dados_excluir[0]['cpf'];


echo '
<table class="table table-sm mt-3 tabelas">
<thead class="thead-light">
<tr>
<th scope="col">Remédio</th>
<th scope="col">Quantidade</th>
<th scope="col">Valor</th>
<th scope="col">Fornecedor</th>

<th scope="col">Data</th>

<th scope="col">Ações</th>
</tr>
</thead>
<tbody>';




$txtbuscar = '%'.@$_POST['txtbuscar'].'%';
$res = $pdo->query("SELECT * from entradas_remedios where nome_remedio LIKE '$txtbuscar' and data = '$data' and farmaceutico = '$cpf_usuario' order by id desc");



$dados = $res->fetchAll(PDO::FETCH_ASSOC);





for ($i=0; $i < count($dados); $i++) { 
	foreach ($dados[$i] as $key => $value) {
	}

	$id = $dados[$i]['id'];	
	$remedio = $dados[$i]['remedio'];
	$quantidade = $dados[$i]['quantidade'];
	$valor = $dados[$i]['valor'];
	$fornecedor = $dados[$i]['fornecedor'];
	$farmaceutico = $dados[$i]['farmaceutico'];
	$nome_remedio = $dados[$i]['nome_remedio'];
	$data = $dados[$i]['data'];
	$data2 = implode('/', array_reverse(explode('-', $data)));


	

	//BUSCAR O NOME DO FORNECEDOR
	$res_forn = $pdo->query("select * from fornecedores where id = '$fornecedor'");
	$dados_forn = $res_forn->fetchAll(PDO::FETCH_ASSOC);
	$nome_forn= $dados_forn[0]['nome'];


	echo '
	<tr>


	<td>'.$nome_remedio.'</td>
	<td>'.$quantidade.'</td>
	<td>R$ '.$valor.'</td>
	<td>'.$nome_forn.'</td>
	
	<td>'.$data2.'</td>

	<td>

	
	<a href="index.php?acao='.$pagina.'&funcao=excluir&id='.$id.'"><i class="far fa-trash-alt text-danger"></i></a>
	</td>
	</tr>';

}

echo  '
</tbody>
</table> ';




?>
<?php 

require_once("conexao.php");
require_once("config.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>SYS MEDICAL LOGIN</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="css/painel.css" crossorigin="anonymous">


</head>
<body>

<div class="container-tela">
<big><big>
<table class="table table-lg mt-3">
<thead class="thead-light">
<tr>
<th scope="col">Paciente</th>
<th scope="col">Hora</th>
<th scope="col">Atendimento</th>
<th scope="col">Médico</th>
<th scope="col">Consultório</th>


</tr>
</thead>
<tbody>



<?php


 		$itens_por_pagina = $itens_tela;

		//PEGAR A PÁGINA ATUAL
		$pagina_pag = intval(@$_GET['pagina']);
		
		$limite = $pagina_pag * $itens_por_pagina;

		//CAMINHO DA PAGINAÇÃO
		$caminho_pag = 'tela.php?'; 

$res = $pdo->query("SELECT * from consultas where data = curDate() and pgto_confirmado = 'sim' and (status = 'Aguardando' or status = 'Consultando') order by hora asc LIMIT $limite, $itens_por_pagina");


$dados = $res->fetchAll(PDO::FETCH_ASSOC);

//TOTALIZAR OS REGISTROS PARA PAGINAÇÃO
		$res_todos = $pdo->query("SELECT * from consultas where data = curDate() and pgto_confirmado = 'sim'");
		$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
		$num_total = count($dados_total);

		//DEFINIR O TOTAL DE PAGINAS
		$num_paginas = ceil($num_total/$itens_por_pagina);
	


for ($i=0; $i < count($dados); $i++) { 
	foreach ($dados[$i] as $key => $value) {
	}

	$id = $dados[$i]['id'];	
	$paciente = $dados[$i]['paciente'];
	$hora = $dados[$i]['hora'];
	$tipo_atendimento = $dados[$i]['tipo_atendimento'];
	$medico = $dados[$i]['medico'];
	$valor = $dados[$i]['valor'];
	$pgto_confirmado = $dados[$i]['pgto_confirmado'];
	$status = $dados[$i]['status'];


	//BUSCAR O NOME DO PACIENTE
	$res_valor = $pdo->query("SELECT * from pacientes where id = '$paciente'");
	$dados_valor = $res_valor->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_valor);

	if($linhas > 0){

		$nome_paciente = $dados_valor[0]['nome'];	

	}


	//BUSCAR O NOME DO MÉDICO
	$res_med = $pdo->query("SELECT * from medicos where id = '$medico'");
	$dados_med = $res_med->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_med);

	if($linhas > 0){

		$nome_medico = $dados_med[0]['nome'];	
		$consultorio = $dados_med[0]['consultorio'];	

	}


	//BUSCAR O TIPO DE ATENDIMENTO
	$res_med = $pdo->query("SELECT * from atendimentos where id = '$tipo_atendimento'");
	$dados_med = $res_med->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_med);

	if($linhas > 0){

		$atendimento = $dados_med[0]['descricao'];	

	}


	if($status == 'Consultando'){
		echo '<tr class="table-primary">';
	}else{
		echo '<tr>';
	}

	?>


	<td><?php echo $nome_paciente ?></td>
	<td><?php echo $hora ?></td>
	<td><?php echo $atendimento ?></td>
	<td><?php echo $nome_medico ?></td>
	<td><?php echo $consultorio ?> - <small><small><?php echo $status ?></small></small></td>


	</tr>

<?php } ?>


</tbody>
</table> 



<!--ÁREA DA PÁGINAÇÃO -->
<nav class="paginacao" aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <a class="btn btn-outline-dark btn-sm mr-1" href="<?php echo $caminho_pag; ?>pagina=0&itens=<?php echo $itens_por_pagina ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <?php 
            for($i=0;$i<$num_paginas;$i++){
            $estilo = "";
            if($pagina_pag == $i)
              $estilo = "active";
            ?>
             <li class="page-item"><a class="btn btn-outline-dark btn-sm mr-1 <?php echo $estilo; ?>" href="<?php echo $caminho_pag; ?>pagina=<?php echo $i; ?>&itens=<?php echo $itens_por_pagina ?>"><?php echo $i+1; ?></a></li>
          <?php } ?>
            
            <li class="page-item">
              <a class="btn btn-outline-dark btn-sm" href="<?php echo $caminho_pag; ?>pagina=<?php echo $num_paginas-1; ?>&itens=<?php echo $itens_por_pagina ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
</nav>



</big></big>
</div>

</body>
</html>


<?php 

if(!isset($_GET['pagina']) || $_GET['pagina'] >= ($num_paginas - 1)){
	echo "<meta HTTP-EQUIV='refresh' CONTENT='$tempo_atualizacao_tela;URL=tela.php?pagina=0'>"; 
}else{
	$valor = @$_GET['pagina'] + 1;
	echo "<meta HTTP-EQUIV='refresh' CONTENT='$tempo_atualizacao_tela;URL=tela.php?pagina=$valor'>"; 
}


 ?>
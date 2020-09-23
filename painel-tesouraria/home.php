<?php 


$res = $pdo->query("SELECT * from movimentacoes where data = curDate()");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);

$total_entradas = 0;
$total_saidas = 0;

for ($i=0; $i < count($dados); $i++) { 
	foreach ($dados[$i] as $key => $value) {
	}

	$id = $dados[$i]['id'];	
	$tipo = $dados[$i]['tipo'];
	$valor = $dados[$i]['valor'];
	

	if($tipo == 'Entrada'){
		@$total_entradas = $total_entradas + $valor;
	}else{
		@$total_saidas = $total_saidas + $valor;
	}

}

@$total = @$total_entradas - @$total_saidas;

?>

<div class="area_cards">
	<div class="row">

		<div class="col-sm-12 col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center text-success">
								<i class="far fa-money-bill-alt"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="numbers">
								<p class="titulo-card">Total Entradas</p>
								<p class="subtitulo-card">R$ <?php echo round(@$total_entradas) ?><p> 
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer rodape-card">
						Entradas do Dia

					</div>
				</div>
			</div>


			<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
				<div class="card card-stats">
					<div class="card-body ">
						<div class="row">
							<div class="col-5 col-md-4">
								<div class="icone-card text-center text-danger">
									<i class="far fa-money-bill-alt"></i>
								</div>
							</div>
							<div class="col-7 col-md-8">
								<div class="numbers">
									<p class="titulo-card">Total Saídas</p>
									<p class="subtitulo-card">R$ <?php echo round(@$total_saidas) ?><p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer rodape-card">
							Saídas do Dia

						</div>
					</div>
				</div>


				<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
					<div class="card card-stats">
						<div class="card-body ">
							<div class="row">
								<div class="col-5 col-md-4">
									<?php 
									if($total > 0){
										echo '<div class="icone-card text-center text-success">';
									}else{
										echo '<div class="icone-card text-center text-danger">';
									}
									?>


									<i class="fas fa-coins"></i>
								</div>
							</div>
							<div class="col-7 col-md-8">
								<div class="numbers">
									<p class="titulo-card">Saldo Total</p>
									<p class="subtitulo-card">R$ <?php echo round($total) ?><p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer rodape-card">
							Total do Dia

						</div>
					</div>
				</div>

			</div>
		</div>











	<div class="mt-4">
				<span class="text-muted">Ultimas Movimentações</span>
				<table class="table table-sm mt-3 tabelas">
					<thead class="thead-light">
						<tr>
							<th scope="col">Tipo</th>
<th scope="col">Movimento</th>
<th scope="col">Valor</th>
<th scope="col">Tesoureiro</th>



						</tr>
					</thead>
					<tbody>



						<?php 
						$res = $pdo->query("SELECT * from movimentacoes where data = curDate() order by id desc limit 6");



						$dados = $res->fetchAll(PDO::FETCH_ASSOC);

						for ($i=0; $i < count($dados); $i++) { 
							foreach ($dados[$i] as $key => $value) {
							}

							$id = $dados[$i]['id'];	
	$tipo = $dados[$i]['tipo'];
	$valor = $dados[$i]['valor'];
	$data = $dados[$i]['data'];
	$movimento = $dados[$i]['movimento'];
	$tesoureiro = $dados[$i]['tesoureiro'];


								//BUSCAR O NOME DO TESOUREIRO
	$res_excluir = $pdo->query("select * from tesoureiros where cpf = '$tesoureiro'");
	$dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
	$nome_tesoureiro = $dados_excluir[0]['nome'];



							?>
							<tr>


								<td><?php echo $tipo ?></td>
								<td><?php echo $movimento ?></td>
								<td>R$ <?php echo $valor ?></td>
								<td><?php echo $nome_tesoureiro ?></td>



							</tr>
						<?php } ?>


					</tbody>
				</table>

			</div>

		</div>
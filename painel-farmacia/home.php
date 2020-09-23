<?php 


$res_nivel = $pdo->query("select * from remedios where estoque <= '$nivel_estoque' ");

$dados_nivel = $res_nivel->fetchAll(PDO::FETCH_ASSOC);
$estoque_baixo = count($dados_nivel);


$res_ent = $pdo->query("select * from entradas_remedios where data = curDate() ");

$dados_ent = $res_ent->fetchAll(PDO::FETCH_ASSOC);
$estoque_ent = count($dados_ent);


$res_saida = $pdo->query("select * from saidas_remedios where data = curDate() ");

$dados_saida = $res_saida->fetchAll(PDO::FETCH_ASSOC);
$estoque_saida = count($dados_saida);

?>


<div class="area_cards">
	<div class="row">

		<div class="col-sm-12 col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center text-warning">
								<i class="fas fa-globe"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="numbers">
								<p class="titulo-card">Estoque Baixo</p>
								<p class="subtitulo-card"><?php echo $estoque_baixo ?><p>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer rodape-card">
						Remédios com Estoque Baixo

					</div>
				</div>
			</div>


			<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
				<div class="card card-stats">
					<div class="card-body ">
						<div class="row">
							<div class="col-5 col-md-4">
								<div class="icone-card text-center text-success">
									<i class="far fa-envelope-open"></i>
								</div>
							</div>
							<div class="col-7 col-md-8">
								<div class="numbers">
									<p class="titulo-card">Entradas de Remédios</p>
									<p class="subtitulo-card"><?php echo $estoque_ent ?><p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer rodape-card">
							Total de Entradas Hoje

						</div>
					</div>
				</div>


				<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
					<div class="card card-stats">
						<div class="card-body ">
							<div class="row">
								<div class="col-5 col-md-4">
									<div class="icone-card text-center text-danger">
										<i class="fas fa-sign-out-alt"></i>
									</div>
								</div>
								<div class="col-7 col-md-8">
									<div class="numbers">
										<p class="titulo-card">Saída de Remédios</p>
										<p class="subtitulo-card"><?php echo $estoque_saida ?><p>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer rodape-card">
								Total de Saídas Hoje

							</div>
						</div>
					</div>

				</div>







				<div class="mt-4">
					<span class="text-muted">Remédios com Níveis Baixos</span>
					<table class="table table-sm mt-3 tabelas">
						<thead class="thead-light">
							<tr>
								<th scope="col">Nome</th>
								<th scope="col">Descrição</th>
								<th scope="col">Estoque</th>



							</tr>
						</thead>
						<tbody>



							<?php 
							$res = $pdo->query("SELECT * from remedios order by estoque asc limit 8");



							$dados = $res->fetchAll(PDO::FETCH_ASSOC);

							for ($i=0; $i < count($dados); $i++) { 
								foreach ($dados[$i] as $key => $value) {
								}

								$id = $dados[$i]['id'];	
								$nome = $dados[$i]['nome'];
								$descricao = $dados[$i]['descricao'];
								$estoque = $dados[$i]['estoque'];



								?>
								<tr>


									<td><?php echo $nome ?></td>
									<td><?php echo $descricao ?></td>
									<td><?php echo $estoque ?></td>



								</tr>
							<?php } ?>


						</tbody>
					</table>

				</div>

			</div>
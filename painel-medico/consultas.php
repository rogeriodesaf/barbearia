<?php
$pagina = 'consultas'; 
$agora = date('Y-m-d');

?>

<div class="row botao-novo">
	<div class="col-md-12">
		
		
	</div>
</div>

<div class="row mt-4">
	<div class="col-md-6 col-sm-12">
		<div class="float-left">
			
		</div>

	</div>



	

	<div class="col-md-6 col-sm-12">

		<div class="float-right mr-4">
			<form id="frm" class="form-inline my-2 my-lg-0" method="post">

				<input type="hidden" id="pag"  name="pag" value="<?php echo @$_GET['pagina'] ?>">

				<input type="hidden" id="id_consulta"  name="id_consulta" value="<?php echo @$_GET['id'] ?>">

				<input type="hidden" id="itens"  name="itens" value="<?php echo @$itens_por_pagina; ?>">

				<input class="form-control form-control-sm mr-sm-2" type="date" name="txtbuscar" id="txtbuscar" value="<?php echo $agora ?>">
				<button class="btn btn-outline-secondary btn-sm my-2 my-sm-0" name="btn-buscar" id="btn-buscar"><i class="fas fa-search"></i></button>
				
			</form>
		</div>
		
	</div>

	
</div>


<div id="listar">
	
</div>



<!--CHAMADA DA MODAL CONSULTANDO -->
<?php 
if(@$_GET['funcao'] == 'consultando'){ 
	$id = $_GET['id'];
	?>

	<div class="modal" id="modal-consultando" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Status Consultando</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<p>Deseja realmente Mudar o Status para Consultando?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-fechar">Cancelar</button>
					<form method="post">
						<input type="hidden" id="id"  name="id" value="<?php echo @$id ?>" required>

						<button type="button" id="btn-consultando" name="btn-consultando" class="btn btn-success">Alterar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	
<?php } ?>



<script>$('#modal-consultando').modal("show");</script>






<!--CHAMADA DA MODAL FINALIZADA -->
<?php 
if(@$_GET['funcao'] == 'finalizar'){ 
	$id = $_GET['id'];
	?>

	<div class="modal" id="modal-finalizar" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Status Finalizada</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<p>Deseja realmente Mudar o Status para Finalizada?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-fechar">Cancelar</button>
					<form method="post">
						<input type="hidden" id="id"  name="id" value="<?php echo @$id ?>" required>

						<button type="button" id="btn-finalizar" name="btn-finalizar" class="btn btn-success">Alterar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	
<?php } ?>



<script>$('#modal-finalizar').modal("show");</script>







<!--CHAMADA DA MODAL RELATÓRIO DE ATESTADO -->
<?php 
if(@$_GET['funcao'] == 'atestado'){ 
	$id = $_GET['id'];
	?>

	<div class="modal" id="modal-atestado" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Gerar Atestado</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<form method="post">
						<input class="form-control form-control-sm mr-sm-2" type="hidden" name="dataFinalPost" id="dataFinalPost">


						<div class="form-group">
							<label for="exampleFormControlInput1">Dias</label>
							<input class="form-control form-control-sm mr-sm-2" type="text" name="dias" id="dias" required>
						</div>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-fechar">Cancelar</button>

						<input type="hidden" id="id"  name="id" value="<?php echo @$id ?>" required>

						<button type="button" id="btn-atestado" name="btn-atestado" class="btn btn-success">Gerar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	
<?php } ?>


<script>$('#modal-atestado').modal("show");</script>










<!--CHAMADA DA MODAL RELATÓRIO DE PRESCRICAO -->
<?php 
if(@$_GET['funcao'] == 'prescricao'){ 
	$id = $_GET['id'];
	?>

	<div class="modal" id="modal-prescricao" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Gerar Prescrição</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<form method="post">
						<input class="form-control form-control-sm mr-sm-2" type="hidden" name="dataFinalPost" id="dataFinalPost">



						

						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="exampleFormControlInput1">Item</label>
									<input class="form-control form-control-sm mr-sm-2" type="number" name="item" id="item"  required>
								</div>
							</div>

							<div class="col-md-10">
								<div class="form-group">
									<label for="exampleFormControlInput1">Remédio</label>
									<input class="form-control form-control-sm mr-sm-2" type="text" name="remedio" id="remedio" required>
								</div>
							</div>
						</div>

						
					

						
						<div id="listar-prescricao">

						</div>


						<div id="mensagem" class="">

					</div>
						


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-fechar">Cancelar</button>

						<input type="hidden" id="id_consulta"  name="id_consulta" value="<?php echo @$id ?>" required>

						<button type="button" id="btn-prescricao" name="btn-prescricao" class="btn btn-success">Salvar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	
<?php } ?>


<script>$('#modal-prescricao').modal("show");</script>










<!--CHAMADA DA MODAL RELATÓRIO DE RECEITA -->
<?php 
if(@$_GET['funcao'] == 'receita'){ 
	$id = $_GET['id'];
	?>

	<div class="modal" id="modal-receita" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Gerar Receita</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<form method="post">
						<input class="form-control form-control-sm mr-sm-2" type="hidden" name="dataFinalPost" id="dataFinalPost">



						

						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="exampleFormControlInput1">Item</label>
									<input class="form-control form-control-sm mr-sm-2" type="number" name="item_receita" id="item_receita"  required>
								</div>
							</div>

							<div class="col-md-10">
								<div class="form-group">
									<label for="exampleFormControlInput1">Remédio</label>
									<input class="form-control form-control-sm mr-sm-2" type="text" name="remedio" id="remedio" required>
								</div>
							</div>
						</div>

						
					

						
						<div id="listar-receita">

						</div>


						<div id="mensagem" class="">

					</div>
						


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-fechar">Cancelar</button>

						<input type="hidden" id="id_consulta"  name="id_consulta" value="<?php echo @$id ?>" required>

						<button type="button" id="btn-receita" name="btn-receita" class="btn btn-success">Salvar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	
<?php } ?>


<script>$('#modal-receita').modal("show");</script>









<?php 
if(@$_GET['funcao'] == 'editar'){ 
	$id_reg = $_GET['id'];
	?>
	<!-- Modal -->
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><?php if(@$_GET['funcao'] == 'editar'){

						$nome_botao = 'Editar';


					//BUSCAR DADOS DO REGISTRO A SER EDITADO
						$res = $pdo->query("select * from pacientes where id = '$id_reg'");
						$dados = $res->fetchAll(PDO::FETCH_ASSOC);
						$nome = $dados[0]['nome'];
						$cpf = $dados[0]['cpf'];
						$rg = $dados[0]['rg'];
						$telefone = $dados[0]['telefone'];
						$email = $dados[0]['email'];
						$data = $dados[0]['data_nasc'];
						$idade = $dados[0]['idade'];
						$civil = $dados[0]['civil'];
						$sexo = $dados[0]['sexo'];
						$endereco = $dados[0]['endereco'];
						$obs = $dados[0]['obs'];


						echo 'Dados do Paciente';
					}else{
						$nome_botao = 'Salvar';
						echo 'Dados do Paciente';
					} ?>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">


				<form method="post">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">

								<input type="hidden" id="id"  name="id" value="<?php echo @$id_reg ?>" required>

								<input type="hidden" id="campo_antigo"  name="campo_antigo" value="<?php echo @$cpf ?>" required>


								<label for="exampleFormControlInput1">Nome</label>
								<input type="text" class="form-control" id="nome" placeholder="Insira o Nome " name="nome" value="<?php echo @$nome ?>" disabled>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleFormControlInput1">CPF</label>
								<input type="text" class="form-control" id="cpf" placeholder="Insira o CPF " name="cpf" value="<?php echo @$cpf ?>" disabled>
							</div>
						</div>

					</div>



					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleFormControlInput1">RG</label>
								<input type="text" class="form-control" id="rg" placeholder="Insira o RG " name="rg" value="<?php echo @$rg ?>" disabled>
							</div>

						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleFormControlInput1">Telefone</label>
								<input type="text" class="form-control" id="telefone" placeholder="Insira o Telefone " name="telefone" value="<?php echo @$telefone ?>" disabled>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleFormControlInput1">Email</label>
								<input type="email" class="form-control" id="telefone" placeholder="Insira o Email " name="email" value="<?php echo @$email ?>" disabled>
							</div>
						</div>

					</div>






					<div class="row">
						<div class="col-md-4">
							<label for="exampleFormControlSelect1">Estado Civil</label>
							<input type="text" class="form-control" id="civil" placeholder="Insira o Email " name="civil" value="<?php echo @$civil ?>" disabled>
						</div>

						<div class="col-md-4">
							<label for="exampleFormControlSelect1">Sexo</label>
							<input type="email" class="form-control" id="sexo" placeholder="Insira o Email " name="sexo" value="<?php echo @$sexo ?>" disabled>

						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleFormControlInput1">Idade</label>
								<input type="email" class="form-control" id="idade" placeholder="Insira o Email " name="idade" value="<?php echo @$idade ?>" disabled>
							</div>
						</div>



					</div>




					<div class="form-group">
						<label for="exampleFormControlInput1">Observações</label>
						<textarea  class="form-control" id="obs" name="obs" maxlength="350"><?php echo 	@$obs; ?></textarea>
					</div>








					<div id="mensagem" class="">

					</div>

				</div>
				<div class="modal-footer">
					<button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

					<button type="submit" name="<?php echo $nome_botao ?>" id="<?php echo $nome_botao ?>" class="btn btn-primary"><?php echo $nome_botao ?></button>

				</div>
			</form>
		</div>
	</div>
</div>


<?php 	} ?>

<script>$('#modal').modal("show");</script>






<!--AJAX PARA BUSCAR OS DADOS -->
<script type="text/javascript">
	$(document).ready(function(){

		var pag = "<?=$pagina?>";
		$('#btn-buscar').click(function(event){
			event.preventDefault();	
			
			$.ajax({
				url: pag + "/listar.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "html",
				success: function(result){
					$('#listar').html(result)
					
				},
				

			})

		})

		
	})
</script>








<!--AJAX PARA LISTAR OS DADOS -->
<script type="text/javascript">
	$(document).ready(function(){
		
		var pag = "<?=$pagina?>";

		$.ajax({
			url: pag + "/listar.php",
			method: "post",
			data: $('#frm').serialize(),
			dataType: "html",
			success: function(result){
				$('#listar').html(result)

			},

			
		})
	})
</script>



<!--AJAX PARA BUSCAR OS DADOS PELA TXT -->
<script type="text/javascript">
	$('#txtbuscar').change(function(){
		$('#btn-buscar').click();
	})
</script>




<!--AJAX PARA EDIÇÃO DO STATUS DA CONSULTA PARA CONSULTANDO -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#btn-consultando').click(function(event){
			event.preventDefault();
			
			$.ajax({
				url: pag + "/consultando.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){

					$('#mensagem').removeClass()

					if(mensagem == 'Editado com Sucesso!!'){
						
						$('#mensagem').addClass('mensagem-sucesso')
						$('#btn-fechar').click();
						$('#btn-buscar').click();
						




					}else{
						
						$('#mensagem').addClass('mensagem-erro')
					}
					
					$('#mensagem').text(mensagem)

				},
				
			})
		})
	})
</script>




<!--AJAX PARA EDIÇÃO DO STATUS DA CONSULTA PARA FINALIZADA -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#btn-finalizar').click(function(event){
			event.preventDefault();
			
			$.ajax({
				url: pag + "/finalizar.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){

					$('#mensagem').removeClass()

					if(mensagem == 'Editado com Sucesso!!'){
						
						$('#mensagem').addClass('mensagem-sucesso')
						$('#btn-fechar').click();
						$('#btn-buscar').click();
						




					}else{
						
						$('#mensagem').addClass('mensagem-erro')
					}
					
					$('#mensagem').text(mensagem)

				},
				
			})
		})
	})
</script>




<!--AJAX PARA EDIÇÃO DAS OBS DO PACIENTE -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#Editar').click(function(event){
			event.preventDefault();
			
			$.ajax({
				url: pag + "/editar.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){

					$('#mensagem').removeClass()

					if(mensagem == 'Editado com Sucesso!!'){
						
						$('#mensagem').addClass('mensagem-sucesso')
						$('#btn-fechar').click();
						$('#btn-buscar').click();
						




					}else{
						
						$('#mensagem').addClass('mensagem-erro')
					}
					
					$('#mensagem').text(mensagem)

				},
				
			})
		})
	})
</script>






<!--AJAX PARA LANÇAR OS DIAS DE ATESTADO -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#btn-atestado').click(function(event){
			event.preventDefault();
			
			$.ajax({
				url: pag + "/atestado.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){

					$('#mensagem').removeClass()

					if(mensagem == 'Editado com Sucesso!!'){
						
						$('#mensagem').addClass('mensagem-sucesso')
						$('#btn-fechar').click();
						$('#btn-buscar').click();
						




					}else{
						
						$('#mensagem').addClass('mensagem-erro')
					}
					
					$('#mensagem').text(mensagem)

				},
				
			})
		})
	})
</script>






<!--AJAX PARA LANÇAR PRESCRIÇÃO -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#btn-prescricao').click(function(event){
			event.preventDefault();
			
			$.ajax({
				url: pag + "/prescricao.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){

				$('#btn-buscar').click();
				document.getElementById('remedio').value = '';
				document.getElementById('item').value = document.getElementById('num_item').value;
				document.getElementById('remedio').focus();

				},
				
			})
		})
	})
</script>






<!--AJAX PARA LISTAR OS DADOS DA PRESCRICAO-->
<script type="text/javascript">
	$(document).ready(function(){
		
		var pag = "<?=$pagina?>";

		$.ajax({
			url: pag + "/listar-prescricao.php",
			method: "post",
			data: $('#frm').serialize(),
			dataType: "html",
			success: function(result){
				$('#listar-prescricao').html(result);
				document.getElementById('item').value = document.getElementById('num_item').value;

			},

			
		})
	})
</script>







<!--AJAX PARA BUSCAR OS DADOS DA PRESCRICAO -->
<script type="text/javascript">
	$(document).ready(function(){

		var pag = "<?=$pagina?>";
		$('#btn-buscar').click(function(event){
			event.preventDefault();	
			
			$.ajax({
				url: pag + "/listar-prescricao.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "html",
				success: function(result){
					$('#listar-prescricao').html(result)
					document.getElementById('item').value = document.getElementById('num_item').value;
				},
				

			})

		})

		
	})
</script>









<!--AJAX PARA LANÇAR RECEITA -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#btn-receita').click(function(event){
			event.preventDefault();
			
			$.ajax({
				url: pag + "/receita.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){

				$('#btn-buscar').click();
				document.getElementById('remedio').value = '';
				document.getElementById('item_receita').value = document.getElementById('num_item_receita').value;
				document.getElementById('remedio').focus();

				},
				
			})
		})
	})
</script>






<!--AJAX PARA LISTAR OS DADOS DA receita-->
<script type="text/javascript">
	$(document).ready(function(){
		
		var pag = "<?=$pagina?>";

		$.ajax({
			url: pag + "/listar-receita.php",
			method: "post",
			data: $('#frm').serialize(),
			dataType: "html",
			success: function(result){
				$('#listar-receita').html(result);
				document.getElementById('item_receita').value = document.getElementById('num_item_receita').value;

			},

			
		})
	})
</script>







<!--AJAX PARA BUSCAR OS DADOS DA RECEITA -->
<script type="text/javascript">
	$(document).ready(function(){

		var pag = "<?=$pagina?>";
		$('#btn-buscar').click(function(event){
			event.preventDefault();	
			
			$.ajax({
				url: pag + "/listar-receita.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "html",
				success: function(result){
					$('#listar-receita').html(result)
					document.getElementById('item_receita').value = document.getElementById('num_item_receita').value;
				},
				

			})

		})

		
	})
</script>
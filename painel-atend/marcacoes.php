<?php 

$pagina = 'marcacoes'; 
$agora = date('Y-m-d');

//RECUPERAR O ID DO PACIENTE
if(isset($_GET['id'])){
	$id_paciente = $_GET['id'];
	$cpf_paciente = $_GET['cpf'];

}

?>

<input type="hidden" id="txtidpac"  name="txtidpac" value="<?php echo @$id_paciente; ?>">



<div class="row mt-4 mb-3">
	<div class="col-md-6 col-sm-12">
		<form id="frm" class="form-inline my-2 my-lg-0" method="post">


		<input class="form-control form-control-sm mr-sm-2" type="search" placeholder="CPF do Paciente" aria-label="Search" name="txtbuscar-paciente" id="txtbuscar-paciente" value="<?php echo @$cpf_paciente ?>">

			<button class="btn btn-outline-secondary btn-sm my-2 my-sm-0" name="btn-buscar-paciente" id="btn-buscar-paciente"><i class="fas fa-search"></i></button>
		</form>
	</div>


	
	

	<div class="col-md-6 col-sm-12">

		<div class="float-right mr-4">
			<form id="frm" class="form-inline my-2 my-lg-0" method="post">

				<input type="hidden" id="pag"  name="pag" value="<?php echo @$_GET['pagina'] ?>">

				<input type="hidden" id="itens"  name="itens" value="<?php echo @$itens_por_pagina; ?>">

				
						<label class="mr-1" for="exampleFormControlSelect1"><small>Médicos</small></label>
						<select class="form-control form-control-sm mr-2" id="cbmedicos" name="cbmedicos">



							<?php 
								

								//TRAZER TODOS OS REGISTROS DE MÉDICOS
								$res = $pdo->query("SELECT * from medicos order by nome asc");
								$dados = $res->fetchAll(PDO::FETCH_ASSOC);

								for ($i=0; $i < count($dados); $i++) { 
									foreach ($dados[$i] as $key => $value) {
									}

									$id = $dados[$i]['id'];	
									$nome = $dados[$i]['nome'];

									
									echo '<option value="'.$id.'">'.$nome.'</option>';
									

									
								}
								?>
							</select>
						

				<input class="form-control form-control-sm mr-sm-2" type="date" name="txtbuscar" id="txtbuscar" value="<?php echo $agora ?>">

				<button class="btn btn-outline-secondary btn-sm my-2 my-sm-0" name="btn-buscar" id="btn-buscar"><i class="fas fa-search"></i></button>
			</form>
		</div>
		
	</div>

	
</div>



<div id="listar-pacientes">
	
</div>

<div id="listar" class="mt-4">
	

</div>








<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					Gerar Marcação
			</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">


			<form method="post">

				<div class="form-group">

					<input type="hidden" id="id"  name="id"  required>
					<input type="hidden" id="txtid"  name="txtid" required>
					<input type="hidden" id="medico"  name="medico" required>
					<input type="hidden" id="data"  name="data" required>
					<input type="hidden" id="hora"  name="hora" required>
					
					<div class="form-group">
						<label for="exampleFormControlSelect1">Atendimentos</label>
						<select class="form-control" id="atendimentos" name="atendimentos">



							<?php 
															


								//TRAZER TODOS OS REGISTROS DE ESPECIALIZAÇÕES
								$res = $pdo->query("SELECT * from atendimentos order by descricao asc");
								$dados = $res->fetchAll(PDO::FETCH_ASSOC);

								for ($i=0; $i < count($dados); $i++) { 
									foreach ($dados[$i] as $key => $value) {
									}

									$id = $dados[$i]['id'];	
									$descricao = $dados[$i]['descricao'];
									$valor = $dados[$i]['valor'];

									
										echo '<option value="'.$id.'">'.$descricao.' - R$ '.$valor.'</option>';
									

									}
								
								?>
							</select>
						</div>

				

				<div id="mensagem" class="">
					
				</div>

			</div>
			<div class="modal-footer">
				<button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				
				<button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-primary">Salvar</button>
				
			</div>
		</form>
	</div>
</div>
</div>






<!--AJAX PARA INSERÇÃO DOS DADOS -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#btn-salvar').click(function(event){
			event.preventDefault();
			
			$.ajax({
				url: pag + "/inserir.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){

					$('#mensagem').removeClass()
					

					if(mensagem == 'Cadastrado com Sucesso!!'){

						document.getElementById("mensagem").style.display = "block";
						
						$('#mensagem').addClass('mensagem-sucesso')

						$('#btn-fechar').click();
						document.getElementById("listar-pacientes").style.display = "none";
						document.getElementById("txtbuscar-paciente").value = "";
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



<!--AJAX PARA BUSCAR OS DADOS PELA DATA AO ALTERAR -->
<script type="text/javascript">
	$('#txtbuscar').change(function(){
		$('#btn-buscar').click();
	})
</script>

<!--AJAX PARA BUSCAR OS DADOS PELA COMBOBOX AO ALTERAR -->
<script type="text/javascript">
	$('#cbmedicos').change(function(){
		$('#btn-buscar').click();
	})
</script>




<!--AJAX PARA BUSCAR OS DADOS DO PACIENTE -->
<script type="text/javascript">
	$(document).ready(function(){

		var pag = "<?=$pagina?>";
		$('#btn-buscar-paciente').click(function(event){
			event.preventDefault();	
			
			$.ajax({
				url: pag + "/listar-pacientes.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "html",
				success: function(result){
					$('#listar-pacientes').html(result)
					
				},
				

			})

		})

		
	})
</script>


<!--AJAX PARA BUSCAR OS DADOS PELA TXT DO PACIENTE -->
<script type="text/javascript">
	$('#txtbuscar-paciente').keyup(function(){
		document.getElementById("listar-pacientes").style.display = "block";
		$('#btn-buscar-paciente').click();

	})
</script>








<!--MASCARAS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script>
	 $(document).ready(function(){
      
      $('#txtbuscar-paciente').mask('000.000.000-00');
      

      });
</script>


<?php 


include('../../conexao.php');



 ?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>

 @page {
            margin: 0px;

        }

.footer {
    position:absolute;
    bottom:0;
    width:100%;
    background-color: #ebebeb;
    padding:10px;
}

.cabecalho {    
    background-color: #ebebeb;
    padding-top:15px;
    margin-bottom:30px;
}

.titulo{
	margin:0;
}

.areaTotais{
	border : 0.5px solid #bcbcbc;
	padding: 15px;
	border-radius: 5px;
	margin-right:25px;
}

.areaTotal{
	border : 0.5px solid #bcbcbc;
	padding: 15px;
	border-radius: 5px;
	margin-right:25px;
	background-color: #f9f9f9;
	margin-top:2px;
}

.pgto{
	margin:1px;
}



</style>


<div class="cabecalho">
	
		<div class="row">
			<div class="col-sm-4">	
			  <img src="../../img/logo-rel.jpg" width="250px">
			</div>
			<div class="col-sm-6">	
			 <h3 class="titulo"><b>SysMedical - Hospitais e Clínicas</b></h3>
			 <h6 class="titulo">Rua da Q-Cursos Networks Nº 1000, Centro - BH - MG - CEP 30555-555</h6>
			</div>
		</div>
	

</div>

<div class="container">

		
			<div class="row">
				<div class="col-sm-12" align="center">	
				   <img src="../../img/rel-remedios.jpg" width="600px">
				</div>
				
				
			</div>

			
		
		<hr>

			

						
		<br><br>

		<?php

			$res = $pdo->query("SELECT * from remedios order by nome asc");
			$dados = $res->fetchAll(PDO::FETCH_ASSOC);



         ?>


		<table class="table">
			<tr bgcolor="#f9f9f9">
				<td style="font-size:12px"> <b>Remédio</b> </td>
				<td style="font-size:12px"> <b>Descrição</b> </td>
				<td style="font-size:12px"> <b> Quantidade</b> </td>
				
				
			</tr>
			

				 <?php 
		  for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {
			}

			$id = $dados[$i]['id'];	
			$nome = $dados[$i]['nome'];
			$descricao = $dados[$i]['descricao'];
			$estoque = $dados[$i]['estoque']; 
                         
                 ?>

                <tr>
				<td style="font-size:12px"> <?php echo $nome; ?> </td>
				<td style="font-size:12px"> <?php echo $descricao; ?> </td>
				<td style="font-size:12px"> <?php echo $estoque; ?> </td>
				
				
				</tr>

			<?php }  ?>
		</table>

	


		<hr>
		

		<hr>

					
			

	
</div>


<div class="footer">
 <p style="font-size:12px" align="center">Desenvolvido por Hugo Vasconcelos - Q-Cursos Networks</p> 
</div>



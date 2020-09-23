<?php 

require_once("../../conexao.php");
@session_start();

$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$data = $_POST['data'];

$valor = str_replace(',', '.', $valor);


//SCRIPT PARA FOTO NO BANCO
$caminho = '../img/' .$_FILES['foto']['name'];
    if ($_FILES['foto']['name'] == ""){
      $imagem = "sem-foto.png";
    }else{
      $imagem = $_FILES['foto']['name']; 
    }
    
    $imagem_temp = $_FILES['foto']['tmp_name']; 
    move_uploaded_file($imagem_temp, $caminho);


$email_usuario = $_SESSION['email_usuario'];

//BUSCAR O CPF DO USUÁRIO LOGADO (NESSE CASO UM TESOUREIRO)
$res_excluir = $pdo->query("select * from tesoureiros where email = '$email_usuario'");
$dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
$func= $dados_excluir[0]['cpf'];


if($descricao == ''){
	echo "Preencha a Descrição!!";
	exit();
}

if($valor == ''){
	echo "Preencha o Valor!";
	exit();
}


	$res = $pdo->prepare("INSERT into contas_pagar (descricao, valor, vencimento, pago, funcionario, foto) values (:descricao, :valor, :vencimento, :pago, :funcionario, :foto)");

	$res->bindValue(":descricao", $descricao);
	$res->bindValue(":valor", $valor);
	$res->bindValue(":vencimento", $data);
	$res->bindValue(":pago", 'Não');
	$res->bindValue(":funcionario", $func);
	$res->bindValue(":foto", $imagem);

	$res->execute();







	

	echo "Cadastrado com Sucesso!!";



?>
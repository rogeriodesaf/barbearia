<?php

require_once "conexao.php";
require_once "config.php";

//VERIFICAR SE EXISTE REGISTRO NA TABELA CHAMADAS E SE NÃO EXISTIR CRIAR

$res_chamadas = $pdo->query("SELECT * from chamadas");
$dados_chamadas = $res_chamadas->fetchAll(PDO::FETCH_ASSOC);
$total_chamadas = count($dados_chamadas);
if ($total_chamadas == 0) {
    $res_insert = $pdo->query("INSERT into chamadas (id, paciente, consultorio, status) values ('1', 'Sem Paciente', '0', 'Aguardando')");
}

//VERIFICAR SE EXISTE REGISTRO NA TABELA USUARIOS E SE NÃO EXISTIR CRIAR
$senha = '123';
$senha_cript = md5($senha);
$res_usuarios = $pdo->query("SELECT * from usuarios");
$dados_usuarios = $res_usuarios->fetchAll(PDO::FETCH_ASSOC);
$total_usuarios = count($dados_usuarios);

if ($total_usuarios == 0) {
    $res_insert = $pdo->query("INSERT into usuarios (nome, usuario, senha, senha_original, nivel) values ('Administrador', '$email_adm', '$senha_cript', '$senha', 'admin')");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>ROK BARBEARIA</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="css/login.css">

    <!--REFERENCIA PARA O FAVICON -->
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon/favicon2.ico" type="image/x-icon">


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>



</head>

<body>

    <div class="login-form">
        <form action="autenticar.php" method="post">
            <div class="logo">
                <img src="img/rok.png" alt="Rok Barbearia">
            </div>
            <h2 class="text-center">
                Entre no Sistema
            </h2>
            <div class="form-group">
                <input class="form-control" type="email" name="usuario" placeholder="Insira seu Email!" required>
            </div>

            <div class="form-group">
                <input class="form-control" type="password" name="senha" placeholder="Insira sua senha!" required>
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="btn-login">LOGIN</button>
            </div>

            <div class="clearfix">
                <label class="float-left checkbox-inline">
                    <input type="checkbox">
                    Lembrar-me
                </label>
                <a data-toggle="modal" data-target="#modal-senha" class="float-right">Recuperar Senha</a>
            </div>



        </form>
    </div>

</body>

</html>




<div class="modal fade" id="modal-senha" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">Recuperar Senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="text-dark" for="exampleInputEmail1">Seu Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="txtEmail">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button name="recuperar-senha" type="submit" class="btn btn-primary">Recuperar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
if (isset($_POST['recuperar-senha'])) {
    $email_usuario = $_POST['txtEmail'];

    $res = $pdo->prepare("SELECT * from usuarios where usuario = :usuario");

    $res->bindValue(":usuario", $email_usuario);
    $res->execute();

    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    $linhas = count($dados);

    if ($linhas > 0) {
        $nome_usu = $dados[0]['nome'];
        $senha_usu = $dados[0]['senha_original'];
        $nivel_usu = $dados[0]['nivel'];

    } else {
        echo "<script language='javascript'>window.alert('Este email não está cadastrado no sistema!'); </script>";
    }

    //AQUI VAI O CÓDIGO DE ENVIO DO EMAIL
    $to = $email_usuario;
    $subject = 'Recuperação de Senha SysMedical';

    $message = "

	Olá $nome_usu!!
	<br><br> Sua senha é <b>$senha_usu </b>

	<br><br> Ir Para o Sistema -> <a href='$url_sistema'  target='_blank'> Clique Aqui </a>

	";

    $remetente = $email_adm;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
    $headers .= "From: " . $remetente;
    mail($to, $subject, $message, $headers);

    echo "<script language='javascript'>window.alert('Sua senha foi enviada no seu email, verifique no spam ou lixo eletrônico!!'); </script>";

    echo "<script language='javascript'>window.location='index.php'; </script>";

}
?>
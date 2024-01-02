<?php

include('connection.php');

if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['id'])){
    die('Você não está logado. <a href="login.php">Clique aqui </a> para logar.');
}
if(isset($_POST['email'])){

    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $mysqli->query("INSERT INTO senhas (email, senha) VALUES ('$email', '$senha')");
}

$id = $_SESSION['id'];
$sql_query = $mysqli->query("SELECT * FROM senhas WHERE id = '$id'") or die($mysqli->error);
$usuario = $sql_query->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Bem vindo, <?php echo $usuario['nome'];?></p>
    <h1>Cadastro de Usuários</h1>
    <form action="" method="post">
        <input type="text" name="email">
        <input type="text" name="senha">
        <button type="submit"> Salvar senha</button>
    </form>

    <a href="logout.php">Sair</a>
</body>
</html>
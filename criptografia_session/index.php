<?php
if(isset($_POST['email'])){
    include('connection.php');

    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $mysqli->query("INSERT INTO senhas (email, senha) VALUES ('$email', '$senha')");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Cadastrar Senha
    <form action="" method="post">
        <input type="text" name="email">
        <input type="text" name="senha">
        <button type="submit"> Salvar senha</button>
    </form>
</body>
</html>
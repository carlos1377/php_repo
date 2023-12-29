<?php


if (isset($_POST['email'])) {
    include('connection.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM senhas WHERE email = '$email'";
    $sql_exec = $mysqli->query($sql) or die($mysqli->error);

    $usuario = $sql_exec->fetch_assoc();

    if (password_verify($senha, $usuario['senha'])) {
        echo "usuario logado!";
    } else {
        echo "falha ao logar";
    }
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
    <form action="" method="post">
        <input type="text" name="email"> <br>
        <input type="text" name="senha"> <br>
        <button type="submit">LOGAR</button>
    </form>
</body>

</html>
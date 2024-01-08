<?php

if (isset($_POST['email']) && isset($_POST['senha'])) {

    include('lib/connection.php');

    $email = $mysqli->escape_string($_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM clientes WHERE email = '$email'";
    $sql_query = $mysqli->query($sql) or die($mysqli->error);

    if ($sql_query->num_rows == 0) {
        echo "o email informado esta incorreto";
    } else {
        $usuario = $sql_query->fetch_assoc();
        if (!password_verify($senha, $usuario['senha'])) {
            echo "A senha informado esta incorreta";
        } else {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['usuario'] = $usuario['id'];
            $_SESSION['admin'] = $usuario['admin'];
            header("Location: clientes.php");
        }
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
        <h1>Entrar</h1>
        <p>
            <label for="">E-mail</label>
            <input type="text" name="email">
        </p>
        <p>
            <label for="">Senha</label>
            <input type="password" name="senha">
        </p>
        <button type="submit">Entrar</button>
    </form>
</body>

</html>
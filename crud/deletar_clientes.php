<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header('Location: index.php');
    die();
}

include('lib/connection.php');

if (isset($_POST['confirmar'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT foto FROM clientes WHERE id = '$id'";
    $query_cliente = $mysqli->query($sql) or die($mysqli->error);
    $cliente = $query_cliente->fetch_assoc();

    $sql = "DELETE FROM clientes WHERE id = '$id'";

    $query = $mysqli->query($sql) or die($mysqli->error);

    if ($query) {
        if (!empty($cliente['foto'])) {
            unlink($cliente['foto']);
        } ?>
        <h1>Cliente deletado com sucesso!</h1>
        <p><a href="clientes.php">Clique aqui</a> para voltar para a lista de clientes</p>
<?php
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente</title>
</head>

<body>
    <h1>Tem certeza que deseja deletar este cliente?</h1>
    <a style="margin: right 40px;" href="clientes.php">Não</a>
    <form action="" method="post">
        <button name="confirmar" value="1" type="submit">Sim</button>
    </form>
</body>

</html>
<?php

include('lib/connection.php');
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    die();
}

$id = $_SESSION['usuario'];

$sql_clientes = "SELECT * FROM clientes WHERE id != '$id'";

$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $query_clientes->num_rows;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela Clientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        table {
            margin-left: auto;
            margin-right: auto;
            border-radius: 50px;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center">
        <h1 style="text-align: center">Lista de Clientes</h1>
    </div>
    <div class="container d-flex justify-content-center align-items-center">
        <p>Estes são os clientes cadastrados no seu sistema:</p>
    </div>
    <table cellpadding="10" class="table table-bordered table-striped w-75 p-3">
        <thead>
            <th>Foto</th>
            <th>ID</th>
            <th>Admin</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Nascimento</th>
            <th>Data de cadastro</th>
            <?php if ($_SESSION['admin']) { ?>
                <th>Ação</th>
            <?php } ?>
        </thead>
        <tbody>
            <?php if ($num_clientes == 0) { ?>
                <tr>
                    <td colspan="<?php if ($_SESSION['admin']) echo 9;
                                    else echo 8; ?>">Nenhum cliente cadastrado</td>
                </tr>
                <?php
            } else {
                while ($cliente = $query_clientes->fetch_assoc()) {

                    $telefone = "Não informado";
                    if (!empty($cliente['telefone'])) {
                        $telefone = formatar_telefone($cliente['telefone']);
                    }
                    $nascimento = "Não informado";
                    if (!empty($cliente['nascimento'])) {
                        $nascimento = formatar_data($cliente['nascimento']);
                    }
                    $data_cadastro = date("d/m/Y H:i", strtotime($cliente['data_cadastro']))
                ?>
                    <tr>
                        <td>
                            <img height="50" src="<?php echo $cliente['foto']; ?>" alt="">
                        </td>
                        <td>
                            <?php echo $cliente['id']; ?>
                        </td>
                        <td>
                            <?php
                            if ($cliente['admin']) {
                                echo "Sim";
                            } else {
                                echo "Nao";
                            } ?>
                        </td>
                        <td>
                            <?php echo $cliente['nome']; ?>
                        </td>
                        <td>
                            <?php echo $cliente['email']; ?>
                        </td>
                        <td>
                            <?php echo $telefone; ?>
                        </td>
                        <td>
                            <?php echo $nascimento; ?>
                        </td>
                        <td>
                            <?php echo $data_cadastro; ?>
                        </td>
                        <?php if ($_SESSION['admin']) { ?>
                            <td> <a href="editar_clientes.php?id=<?php echo $cliente['id']; ?>">Editar</a>
                                <a href="deletar_clientes.php?id=<?php echo $cliente['id']; ?>">Deletar</a>
                            </td>
                        <?php } ?>
                    </tr>
            <?php
                }
            } ?>
        </tbody>
    </table>
    <?php if ($_SESSION['admin']) { ?>
        <div class="container d-flex justify-content-center align-items-center">
            <p class="text-center">
                <a href="cadastrar_cliente.php">Voltar para o cadastro</a>
            </p>
        </div>
    <?php } ?>
    <div class="container d-flex justify-content-center align-items-center">
        <p class="text-center">
            <a href="logout.php">Fazer Logout</a>
        </p>
    </div>
</body>

</html>
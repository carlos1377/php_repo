<?php

function limpar_texto($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}


if (count($_POST) > 0) {

    include('connection.php');
    $erro = false;

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['data_nascimento'];

    if (empty($nome)) {
        $erro = "Preencha o nome";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha o e-mail";
    }
    if (!empty($nascimento)) {
        $tmp = explode('/', $nascimento);
        if (count($tmp) == 3) {
            $nascimento = implode('-', array_reverse($tmp));
        }
    } else {
        $erro = "A data de nascimento deve seguir o padrão dia/mes/ano";
    }
    if (!empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if (strlen($telefone) != 11) {
            $erro = "O telefone deve ser preenchido no padrão (11) 98765-4321";
        }
    }

    if ($erro) {
        echo "<p><b>ERRO: $erro </b></p>";
    } else {
        $sql = "INSERT INTO clientes (nome, email, telefone, nascimento, data_cadastro)
        VALUES ('$nome', '$email', '$telefone', '$nascimento', NOW())";
        $allok = $mysqli->query($sql) or die($mysqli->errno);
        if ($allok) {
            echo "<p><b>Cliente cadstrado com sucesso</b></p>";
            unset($_POST);
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro cliente</title>
</head>

<body>
    <form action="" method="post">
        <a href="clientes.php">Voltar para a lista</a>
        <p>
            <label>Nome</label>
            <input value="<?php if (isset($_POST['nome']))
                echo $_POST['nome']; ?>" name="nome" type="text">
        </p>
        <p>
            <label>E-mail</label>
            <input value="<?php if (isset($_POST['email']))
                echo $_POST['email']; ?>" name="email" type="email">
        </p>
        <p>
            <label>Telefone</label>
            <input value="<?php if (isset($_POST['telefone']))
                echo $_POST['telefone']; ?>" placeholder="(11) 98765-4321"
                name="telefone" type="text">
        </p>
        <p>
            <label>Data de Nascimento</label>
            <input value="<?php if (isset($_POST['data_nascimento']))
                echo $_POST['data_nascimento']; ?>"
                name="data_nascimento" type="date">
        </p>
        <p><button type="submit">Salvar cliente</button></p>
    </form>
</body>

</html>
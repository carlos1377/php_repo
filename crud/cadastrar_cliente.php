<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header('Location: index.php');
    die();
}

function limpar_texto($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}


if (count($_POST) > 0) {

    include('lib/connection.php');
    include('lib/upload.php');
    include('lib/mail.php');

    $erro = false;

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['data_nascimento'];
    $senha_descriptografada = $_POST['senha'];
    $admin = $_POST['admin'];

    if (strlen($senha_descriptografada) < 6 || strlen($senha_descriptografada) > 16) {
        $erro = "A senha deve ter entre 6 e 16 caracteres.";
    }



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
    $path = "";
    if (isset($_FILES['foto'])) {
        $arq = $_FILES['foto'];
        $path = enviarArquivo($arq['error'], $arq['size'], $arq['name'], $arq['tmp_name']);
        if ($path == false) {
            $erro = "Falha ao enviar arquivo, tente novamente.";
        }
    }

    if ($erro) {
        echo "<p><b>ERRO: $erro </b></p>";
    } else {
        $senha = password_hash($senha_descriptografada, PASSWORD_DEFAULT);
        $sql = "INSERT INTO clientes (nome, email, senha, telefone, nascimento, data_cadastro, foto, admin)
        VALUES ('$nome', '$email', '$senha', '$telefone', '$nascimento', NOW(), '$path', '$admin')";
        $allok = $mysqli->query($sql) or die($mysqli->errno);
        if ($allok) {
            enviar_email($email, "Sua conta no meu site foi criada!", "
                <h1>Parabéns!!</h1>
                <p>Sua conta no meu site SiteImaginario.com foi criada com sucesso! </p>
                <p>
                    <b>Login:</b> $email <br>
                    <b>Senha:</b> $senha_descriptografada
                </p>
                <p> Para fazer login acesse <a href=\"https://siteimaginario.com/login.php\">este link. </a></p>
            ");
            echo "<p><b>Cliente cadastrado com sucesso</b></p>";
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
    <form enctype="multipart/form-data" action="" method="post">
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
                                echo $_POST['telefone']; ?>" placeholder="(11) 98765-4321" name="telefone" type="text">
        </p>
        <p>
            <label>Data de Nascimento</label>
            <input value="<?php if (isset($_POST['data_nascimento']))
                                echo $_POST['data_nascimento']; ?>" name="data_nascimento" type="date">
        </p>
        <p>
            <label>Senha</label>
            <input value="<?php if (isset($_POST['senha']))
                                echo $_POST['senha']; ?>" name="senha" type="text">
        </p>
        <p>
            <label>Foto do Usuário</label>
            <input name="foto" type="file">
        </p>
        <p>
            <label>Tipo: </label>
            <input name="admin" value="1" type="radio">ADMIN
            <input name="admin" value="0" checked type="radio">CLIENTE<br>
        </p>
        <p><button type="submit">Salvar cliente</button></p>
    </form>
</body>

</html>
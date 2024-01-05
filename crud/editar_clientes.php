<?php
include('lib/connection.php');
include('lib/upload.php');


function limpar_texto($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}

$id = intval($_GET['id']);

if (count($_POST) > 0) {

    $erro = false;

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['data_nascimento'];
    $senha = $_POST['senha'];
    $sql_code_extra = "";

    $alterar_senha = false;
    if (!empty($senha)) {
        if (strlen($senha) < 6 || strlen($senha) > 16) {
            $erro = "A senha deve ter entre 6 e 16 caracteres.";
        } else {
            $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
            $sql_code_extra .= "senha = '$senha_criptografada',";
        }
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
    if(isset($_FILES['foto'])){
        $arq = $_FILES['foto'];
        $path = enviarArquivo($arq['error'], $arq['size'], $arq['name'], $arq['tmp_name']);
        if($path == false){
            $erro = "Falha ao enviar arquivo, tente novamente.";
        }else{
            $sql_code_extra .= "foto = '$path'," ;
        }
    }

    if ($erro) {
        echo "<p><b>ERRO: $erro </b></p>";
    } else {
        $sql = " UPDATE clientes
        SET nome = '$nome',
        email = '$email',
        $sql_code_extra
        telefone = '$telefone',
        nascimento = '$nascimento'
        WHERE id = '$id'";
        $allok = $mysqli->query($sql) or die($mysqli->errno);
        if ($allok) {
            echo "<p><b>Cliente Atualizado com sucesso</b></p>";
            unset($_POST);
        }
    }
}

$sql = "SELECT * FROM clientes WHERE id = '$id'";
$query_cliente = $mysqli->query($sql) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cliente</title>

</head>

<body>
    <form enctype="multipar/form-data" action="" method="post">
        <a href="clientes.php">Voltar para a lista</a>
        <p>
            <label>Nome</label>
            <input value="<?php echo $cliente['nome']; ?>" name="nome" type="text">
        </p>
        <p>
            <label>E-mail</label>
            <input value="<?php echo $cliente['email']; ?>" name="email" type="email">
        </p>
        <p>
            <label>Senha</label>
            <input name="senha" type="text">
        </p>
        <p>
            <label>Telefone</label>
            <input value="<?php if (!empty($cliente['telefone']))
                echo formatar_telefone($cliente['telefone']); ?>" placeholder="(11) 98765-4321" name="telefone"
                type="text">
        </p>
        <p>
            <label>Data de Nascimento</label>
            <input value="<?php if (!empty($cliente['nascimento']))
                echo formatar_data($cliente['nascimento']); ?>" name="data_nascimento">
        </p>
        <?php
        if (isset($cliente['foto'])) { ?>
            <p>
                <label>Foto Atual:</label>
                <img src="<?php echo $cliente['foto']; ?>" alt="">
            </p>
        <?php } ?>
        <p>
            <label for="">Nova foto de Usuário</label>
            <input name="foto" type="file">
        </p>
        <p><button type="submit">Salvar cliente</button></p>
    </form>
</body>

</html>
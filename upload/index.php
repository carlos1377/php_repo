<?php

include('connection.php');


if(isset($_FILES['arquivo'])){
    $arquivo = $_FILES['arquivo'];

    if($arquivo['error']){
        die('Falha ao enviar o arquivo');
    }
    if($arquivo['size'] > 2097152){
        die('Arquivo muito grande, máximo: 2MB');
    }
    $folder = 'files/';
    $fileName = $arquivo['name'];
    $newNameFile = uniqid();
    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($extension != 'jpg' && $extension != 'txt') {
        die('Tipo de arquivo não aceito');
    }
    $path = $folder . $newNameFile . '.' . $extension;
    $deu_certo = move_uploaded_file($arquivo['tmp_name'], $path);
    if($deu_certo){
        $mysqli->query("INSERT INTO files (nome, path) VALUES('$fileName', '$path')");
        echo "<p> Arquivo enviado com sucesso enviado com sucesso! Para acessa-lo, clique aqui: <a target=\"_blank\"href=\"files/$newNameFile.$extension\">Clique aqui</a></p> ";
    }else{
        echo "Falha ao enviar o arquivo";
    }
}

$sql_arquivos = $mysqli->query("SELECT * FROM files") or die($mysqli->error);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data" action="">
        <p>
            <label for="">Selecione o arquivo</label>
            <input name="arquivo" type="file">
        </p>
        <button type="submit">Enviar arquivo</button>
    </form>

    <table>
        <thead>
            <th>Arquivo</th>
            <th>Data de envio</th>
        </thead>
        <tbody>
        <?php
            while($arquivo = $sql_arquivos->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $arquivo['nome']; ?></td>
                <td></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
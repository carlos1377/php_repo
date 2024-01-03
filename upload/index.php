<?php

include('connection.php');


if(isset($_GET['deletar'])){
    $id = intval($_GET['deletar']);
    $sql = $mysqli->query("SELECT * FROM files WHERE id = '$id'") or die($mysqli->error);
    $arquivo = $sql->fetch_assoc();

    if(unlink($arquivo['path'])){
        $deu_certo = $mysqli->query("DELETE FROM files WHERE id = '$id'") or die($mysqli->error);
        if($deu_certo){
            echo "<p> Arquivo excluido com sucesso!</p>";
            
        }
    }

}
function enviarArquivo($error, $size, $name, $tmp_name){
    include('connection.php');
    if($error){
        die('Falha ao enviar o arquivo');
    }
    if($size > 2097152){
        die('Arquivo muito grande, máximo: 2MB');
    }
    $folder = 'files/';
    $fileName = $name;
    $newNameFile = uniqid();
    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($extension != 'jpg' && $extension != 'txt') {
        die('Tipo de arquivo não aceito');
    }
    $path = $folder . $newNameFile . '.' . $extension;
    $deu_certo = move_uploaded_file($tmp_name, $path);
    if($deu_certo){
        $mysqli->query("INSERT INTO files (nome, path) VALUES('$fileName', '$path')") or die($mysqli->error);
        return true;
    }else{
        return false;
    }
}


if(isset($_FILES['arquivos'])){
    $arquivos = $_FILES['arquivos'];
    $tudo_certo = true;
    foreach($arquivos['name'] as $index=> $arq){
        $deu_certo = enviarArquivo($arquivos['error'][$index], $arquivos['size'][$index], $arquivos['name'][$index], $arquivos['tmp_name'][$index]);
        if(!$deu_certo){
            $tudo_certo = false;
        }
    }
    if($tudo_certo){
        echo "<p> Todos os arquivos foram enviados com sucesso! </p>";
    }else{
        echo "<p> Falha ao enviar um ou mais arquivos!</p>";
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
            <input multiple name="arquivos[]" type="file">
        </p>
        <button type="submit">Enviar arquivo</button>
    </form>

    <table border="1" cellpadding="10">
        <thead>
            <th>Preview</th>
            <th>Arquivo</th>
            <th>Data de envio</th>
            <th></th>
        </thead>
        <tbody>
        <?php
            while($arquivo = $sql_arquivos->fetch_assoc()) {
            ?>
            <tr>
                <td><img height="50" src="<?php echo $arquivo['path'];?>" alt=""></td>
                <td><a href="<?php echo $arquivo['path'] ;?>"><?php echo $arquivo['nome']; ?></a></td>
                <td><?php echo date("d/m/Y", strtotime($arquivo['data_upload']));?></td>
                <td><a href="index.php?deletar=<?php echo $arquivo['id'];?>">Deletar</a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
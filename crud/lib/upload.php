<?php
function enviarArquivo($error, $size, $name, $tmp_name){
    if($error){
        die('Falha ao enviar o arquivo');
    }
    if($size > 2097152){
        die('Arquivo muito grande, máximo: 2MB');
    }
    $folder = './files/';
    $fileName = $name;
    $newNameFile = uniqid();
    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($extension != 'jpg' && $extension != 'png') {
        die('Tipo de arquivo não aceito');
    }
    $path = $folder . $newNameFile . '.' . $extension;
    $deu_certo = move_uploaded_file($tmp_name, $path);
    if($deu_certo){
        return $path;
    }else{
        return false;
    }
}
<?php

$hostname = "localhost";
$database = "carros";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $database);
if ($mysqli->connect_errno){
    die("Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}
else{
    echo 'Conectado!';
}


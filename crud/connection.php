<?php

$hostname = "localhost";
$database = "crud_clientes";
// $table = "clientes";
$username = "root";
$password = "";

$mysqli = new mysqli($hostname, $username, $password, $database);
if ($mysqli->connect_errno) {
    die("Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

function formatar_data($data)
{
    return implode('/', array_reverse(explode('-', $data)));
}

function formatar_telefone($telefone)
{
    $ddd = substr($telefone, 0, 2);
    $parte1 = substr($telefone, 2, 5);
    $parte2 = substr($telefone, 7);
    return "($ddd) $parte1-$parte2";

}
<?php

$hostname = "localhost";
$database = "url_shortner";
$username = "root";
$password = "";

$mysqli = new mysqli($hostname, $username, $password, $database);
if ($mysqli->connect_errno) {
    die("Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

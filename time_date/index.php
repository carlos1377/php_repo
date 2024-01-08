<?php

// timestamps

echo (time() - strtotime('2022-12-29')) / 86400 . '<br>';
echo date('d/m/Y H:i', strtotime('2023-12-28 23:48')) . '<br>';

// mostrar a data atual em timestamp
echo "<p> Data atual em timestamp: " . time() . "</p>";

// transformar timestamp em data atual
echo "<p> Timestamp em data atual: " . date('d/m/Y', time()) . "</p>";

// transformar a data atual em timestamp
echo "<p> Transformada data atual em timestamp: " . strtotime('2023-12-29') . "</p>";

// somar 10 dias em uma data
$date = '2023-12-29';
echo "<p> Somando 10 dias na data atual: " . date('d/m/Y', strtotime($date. ' + 10 days')) . "</p>";

// subtrair 10 dias em uma data
$date = '2023-12-29';
echo "<p> Somando 10 dias na data atual: " . date('d/m/Y', strtotime($date. ' - 10 days')) . "</p>";

//Convertendo o timestamp para o banco de dados
echo "<p> Convertendo o timestamp para o banco de dados: " . date('Y-m-d H:i:s', time()) . "</p>";

// Descobrir o dia da semana de uma data
echo "<p> Descobrir o dia da semana de uma data: " . date('D', time()) . "</p>";


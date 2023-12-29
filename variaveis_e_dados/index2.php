<?php

$dez = 10.0;
$vinte = 20;
$trinta = 30;
$valor = 20;
$valor2 = "20";

$teste = $valor == $vinte;
$teste2 = $valor === $valor2;
$teste3 = $valor == $valor2;
$teste4 = $valor !== $valor2;
$teste5 = $valor != $valor2;

$teste7 = true && false;
$teste8 = false || true;
$teste8 = !false;

$resultado = ($dez * $vinte) - $trinta;

echo $resultado . '<br>';
echo $teste . '<br>';
echo $teste2 . '<br>';
echo $teste3 . '<br>';
echo $teste4 . '<br>';
echo $teste5 . '<br>';
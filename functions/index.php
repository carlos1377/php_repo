<?php

function criaArray($inicio, $fim){
    $lista = [];
    if($fim <= $inicio){
        echo 'não dá pra continuar';
    }
    else{
        for($i = $inicio; $i <= $fim; $i++){
            $lista[] = $i;
        }
        return $lista;
    }
}

function formatar_preco($preco){
    return "R$ " . number_format($preco, 2, ',', '.');
}

echo formatar_preco(5);

$a = criaArray(3, 7);
var_dump($a);
$a = criaArray(1, 0);
var_dump($a);
$a = criaArray(10, 100);
var_dump($a);
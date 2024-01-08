<?php

$lista = array(1,2,3,4);

$lista2 = [1,2,3,4];

$lista3 = [1,2,3, 'a', 5, [1],];

$lista4 = array(
    1=> 'item 1',
    20=> 'item 3',
    50 => 'item 5',
);

$lista4[] = 6;
$lista4[2] = 10;

foreach($lista4 as $i => $value){
    echo "$i - $value <br>";
}

var_dump($lista4);


$lista5 = array();

for($l =10; $l <=20; $l++){
    $lista5[] = $l;
}

var_dump($lista5);

$ultimo = array_pop($lista5);

var_dump($lista5);

$mais_um = array_push($lista5, 10);

var_dump($lista5);
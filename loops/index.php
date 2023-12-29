<?php

$num = 3;
$num2 = 4;

$resultado = 0;

for ($i=0; $i < $num2 ; $i++) { 
    $resultado += $num;
}

echo 'o resutlado da multiplicação é: ' . $resultado . '<br>';

$k = 0;
do {
    $k++;
} while ($k < 9999);

echo $k;

while(false){
    echo 'oi';
}

$nomes = [
    1 => 'carlos',
    3 => 'jose',
    4 => 'gustavo',
    2 => 'rodrigo',
];

var_dump(($nomes));

foreach ($nomes as $i => $nome) {
    echo "$nome no indice $i" . '<br>';
}
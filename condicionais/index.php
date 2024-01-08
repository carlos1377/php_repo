<?php

$nota_aluno = 6;

if ($nota_aluno >= 6 ){
    echo 'passou de ano' . '<br>';
}
else {
    echo 'reprovou' . '<br>';
}

$senha = "123456";

if ($senha != '123456') {
    echo 'senha incorreta' . '<br>';
}
else {
    echo 'senha correta' . '<br>';
}

$numero = 3.6;

if ((int) $numero % 2 == 0) {
    echo 'par' . '<br>';
}
elseif((int) $numero % 2 == 1) {
    echo 'impar' . '<br>';
}

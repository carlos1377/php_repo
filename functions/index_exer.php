<?php

function myPow($number = null, $pow = null)
{
    $number_elevated = $number;
    if (is_null($number) || is_null($pow)) {
        return;
    }
    for ($i = 1; $i < $pow; $i++) {
        $number_elevated *= $number;
    }
    return $number_elevated;
}

$valor = myPow(23, 2);

echo $valor . '<br>';
echo pow(23, 2);
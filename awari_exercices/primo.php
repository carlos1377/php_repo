<?php

function is_prime_number(int $number)
{
    $is_prime = false;
    switch ($number) {
        case in_array($number, array(1, 2, 3, 5, 7)):
            $is_prime = true;
            break;
        case $number % 2 == 0:
            break;
        case $number % 3 == 0:
            break;
        case $number % 4 == 0:
            break;
        case $number % 5 == 0:
            break;
        case $number % 6 == 0:
            break;
        case $number % 7 == 0:
            break;
        default:
            $is_prime = true;
            break;
    }
    return $is_prime;
}

// echo is_prime_number(2);
$lista = array(2, 3, 5, 7, 11, 13, 17, 19, 23, 29);

foreach($lista as $n){
    echo "$n: " . is_prime_number($n) . '<br>';
}
?>
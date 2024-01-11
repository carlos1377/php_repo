<?php 

function fatorial(int $number){
    if($number == 0 || $number == 1){
        return 1;
    }
    return $number * fatorial($number - 1);
}

echo fatorial(5);
?>
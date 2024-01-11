<?php 

$numbers = array(1,10,3,4,5,6,7,8,9);

function max_array(array $array){
    $max_number = 0;
    foreach($array as $i => $n){
        if($i == 0){
            $max_number = $n;
        }else{
            if($n > $max_number){
                $max_number = $n;
            }
        }
    }
    unset($n);
    echo $max_number;
}

max_array($numbers);

?>
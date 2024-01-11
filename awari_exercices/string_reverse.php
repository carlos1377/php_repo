<?php 

function reverse_string(string $string){
    $string_list = str_split($string);
    var_dump($string_list);
    $reversed_array_string = "";
    for($i = count($string_list); $i > 0; $i--){
        // echo $string_list[-($i)];
        $reversed_array_string .= $string_list[$i - 1];
    }
    return $reversed_array_string;
}

echo reverse_string('eduardo');

?>
<?php

if(isset($_POST['value'])){
    $api_key = "99bf13550e4b5afe9abfd785e7acaae4";

    $endpoint = "http://api.exchangeratesapi.io/v1/latest?access_key={$api_key}";

    $request = file_get_contents($endpoint);

    $parsed = json_decode($request, true);

    $value = floatval(str_replace(',', '.', $_POST['value']));
    $brl = $parsed['rates']['BRL'];
    $usd = $parsed['rates']['USD'];
    $result = ($value / $brl) * $usd;

}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <p>
            <label for="">R$</label>    
            <input value="<?php if(isset($_POST['value'])) echo $_POST['value'];?>" type="text" name="value">
        </p>
        <p>
            <button type="submit">Converter para USD</button>
        </p>
    </form>
    <?php
    if(isset($result)){
        $formated = number_format($result, 2, ',', '.');
        echo "<p> US$ {$formated}</p>";
    }
    ?>
</body>
</html>
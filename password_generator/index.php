<?php
if (isset($_POST['length'])) {
    $length = intval($_POST['length']);
    $lowercase = isset($_POST['lowercase']);
    $uppercase = isset($_POST['uppercase']);
    $symbols = isset($_POST['symbols']);
    $number = isset($_POST['number']);

    if (!$lowercase && !$uppercase && !$symbols && !$number) {
        die("Failed to generate password. Choose at least 1 type.");
    }

    $lowercase_chars = "abcdefghijklmnopqrstuvwxyz";
    $uppercase_chars = strtoupper($lowercase_chars);
    $symbols_chars = "!@#$%&*()_-/+=";
    $numbers_chars = "0123456789";

    $password = "";
    $valid_options = "";

    if ($lowercase) {
        $valid_options .= $lowercase_chars;
    }
    if ($uppercase) {
        $valid_options .= $uppercase_chars;
    }
    if ($symbols) {
        $valid_options .= $symbols_chars;
    }
    if ($number) {
        $valid_options .= $numbers_chars;
    }

    for ($i = 0; $i < $length; $i++) {
        $random_number = rand(0, strlen($valid_options) - 1);
        $password .= $valid_options[$random_number];
        $i++;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if (isset($password)) { ?>
        <h4>Generated Password</h4>
        <input type="text" readonly value="<?php echo $password; ?>">
    <?php } ?>
    <h3>Generate a new passsword:</h3>

    <form action="" method="post">
        <p>
            <label for="">Password length</label>
            <input type="number" min="8" value="16" name="length">
        </p>
        <p>
            <label for="">Include Lowercase</label>
            <input type="checkbox" checked value="1" name="lowercase">
        </p>
        <p>
            <label for="">Include Uppercase</label>
            <input type="checkbox" checked value="1" name="uppercase">
        </p>
        <p>
            <label for="">Include Symbols</label>
            <input type="checkbox" checked value="1" name="symbols">
        </p>
        <p>
            <label for="">Include Numbers</label>
            <input type="checkbox" checked value="1" name="numbers">
        </p>
        <p>
            <button type="submit">Generate!</button>
        </p>
    </form>
</body>

</html>
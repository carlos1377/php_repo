<?php 
include 'connection.php';

$url = false;
if(isset($_POST['url'])){
    $hash = uniqid();
    $url = $mysqli->real_escape_string($_POST['url']);
    $views = 0;
    $url_prefix = 'http://localhost/project/short_url/r.php?h=';

    $mysqli->query("INSERT INTO urls (id, url, views) VALUES ('$hash', '$url', '$views')") or die($mysqli->error);
    $url = $url_prefix . $hash;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>url shortner</title>
</head>
<body>
    <form action="" method="post">
        <input type="url" name="url" placeholder="Type your URL here">
        <button type="submit">Submit</button>
    </form>
    <?php if($url !== false){ ?>
        <p>
            URL ENCURTADA:
            <input type="text" readonly value="<?php echo $url ?>">

        </p>
        <?php } ?>
</body>
</html>
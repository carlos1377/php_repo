<?php

include('connection.php');

$limit = 20;



$sql_code = "SELECT * FROM cidades ORDER BY nome ASC LIMIT {$limit} OFFSET 5";
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Cities</h1>
    <table border="1">
        <thead>
            <tr>
                <th>
                    City Name
                </th>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($city = $sql_query->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php echo $city['nome']; ?>
                    </td>
                    <td>
                        Edit | Delete
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>
<?php

include('connection.php');


$sql_city_count = "SELECT COUNT(*) FROM cidades";
$sql_city_count_query = $mysqli->query($sql_city_count) or die($mysqli->error);

$city_count = $sql_city_count_query->fetch_assoc();

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10;
$page_interval = 2;
$offset = ($page - 1) * $limit;

$page_number = ceil($city_count['COUNT(*)'] / $limit);

$sql_code = "SELECT * FROM cidades ORDER BY nome ASC LIMIT {$limit} OFFSET {$offset}";
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
    <h1>Cities
        <?php echo $city_count['COUNT(*)'] ?>
    </h1>
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

    <p>
        <?php echo "page: $page <br>"; ?>
        <?php echo "number of pages: " . $page_number; ?>
    </p>
    <p>
        <a href="?page=1"> << </a>
                <?php
                $first_page = max($page - $page_interval, 1);
                $last_page = min($page_number, $page + $page_interval);
                for ($p = $first_page; $p <= $last_page; $p++) {
                    if ($p === $page) {
                        echo "[{$p}]";
                    } else {
                        echo "<a href='?page={$p}'>[{$p}]</a> ";
                    }
                }
                ?>
                <a href="?page=<?php echo $page_number; ?>"> >> </a>
    </p>
</body>

</html>
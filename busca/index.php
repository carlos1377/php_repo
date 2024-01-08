<?php
include('connection.php');

$pesquisa = "";
if (!empty($_GET['busca'])) {
    $pesquisa = $mysqli->escape_string($_GET['busca']);
}

$sql = "SELECT * FROM veiculos 
WHERE fabricante LIKE '%$pesquisa%' 
OR modelo LIKE '%$pesquisa%' 
OR veiculo LIKE '%$pesquisa%'";

$sql_query = $mysqli->query($sql) or die("ERRO ao consultar: " . $mysqli->error);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Busca</title>
</head>

<body>
    <h1>Lista de veículos</h1>
    <form action="" method="GET">
        <input name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite os termos de pesquisa" type="text">
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table width="600px" border="1">
        <thead>
            <tr>
                <th>fabricante</th>
                <th>veículo</th>
                <th>modelo</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($_GET['busca']) && $sql_query->num_rows != 0) {
                while ($carro = $sql_query->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <?php echo $carro['fabricante']; ?>
                        </td>
                        <td>
                            <?php echo $carro['veiculo']; ?>
                        </td>
                        <td>
                            <?php echo $carro['modelo']; ?>
                        </td>
                    </tr>
                <?php }
            }else {?>
            <tr>
                <td align="center" colspan="3">Digite algo ara pesquisar...</td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</body>

</html>
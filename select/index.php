<?php

include('connection.php');

if(isset($_GET['cidade'])){
    echo "Você selecionou a cidade com o id" . $_GET['cidade'];
    die("<a href=\"index.php\"> Voltar ao index</a>");
}

$sql_states = "SELECT * FROM estados ORDER BY nome ASC";

$sql_query_states = $mysqli->query($sql_states) or die("Falha ao fazer a query: " . $mysqli->error);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select</title>
</head>
<body>
    <form action="" method="get">
        <select <?php if(isset($_GET['estado'])) echo "disabled"; ?> required name="estado">
            <option value="">Selecione um estado</option>
            <?php while($estado = $sql_query_states->fetch_assoc()) {?>
                    <option <?php if(isset($_GET['estado']) && $_GET['estado'] == $estado['id']) echo "selected" ;?>value="<?php echo $estado['id']?>"><?php echo $estado['nome'];?></option>
                <?php }?>
        </select>
        <?php if(isset($_GET['estado'])) { ?>
            <select required name="cidade">
                <option value="">Selecione uma cidade</option>
                <?php
                $selected_state = $mysqli->escape_string($_GET['estado']);
                $sql_code_cities = "SELECT * FROM cidades WHERE id_estado = '$selected_state'";
                $sql_query_cities = $mysqli->query($sql_code_cities) or die("Falha ao fazer a query: " . $mysqli->error);

                while($cidade = $sql_query_cities->fetch_assoc()){ ?>
                <option value="<?php echo $cidade['id'];?>"><?php echo $cidade['nome'];?></option>
                <?php } ?>
            </select>
            <?php } ?>
        <button type="submit">Avançar</button>
    </form>
</body>
</html>
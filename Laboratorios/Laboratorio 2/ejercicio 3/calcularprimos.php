<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

        ol {
            width: 200px;
            border: 1px solid green;
            background-color: yellow;
        }
        li {
            padding: 4px;
        }
    </style>
    <title>Ejercicio 3</title>
</head>

<body>
    <?php
    $numero = $_POST["numero"];
    $cantidadNumerosPrimos = 0;
    $contador = 2;
    $numerosPrimos = array();

    $esPrimo = true;

    while ($cantidadNumerosPrimos != $numero) {
        for ($i = 2; $i < $contador; $i++) {
            if ($contador % $i == 0) {
                $esPrimo = false;
                break;
            }
        }
        if ($esPrimo) {
            $numerosPrimos[] = $contador;
            $cantidadNumerosPrimos++;
        }
        $esPrimo = true;
        $contador++;
    }

    ?>
    <ol>
        <?php 
        foreach ($numerosPrimos as $numeroPrimo) {
            echo "<li>" . $numeroPrimo . "</li>";
        }
        ?>
    </ol>


</body>

</html>
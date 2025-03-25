<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <style>
        ul{
            margin: auto;
            border: 1px solid red;
            background-color: yellow;
            width: 50%;
        }
    </style>

    <title>Ejercicio 4</title>
</head>

<body>
    <?php
    $numeroPalabras = $_POST["numeroPalabras"];

    function ordenarPalabras($palabras)
    {
        sort($palabras);
        return $palabras;
    }


    for ($i = 1; $i <= $numeroPalabras; $i++) {
        $palabras[] = $_POST["palabra" . $i];
    }

    $palabrasOrdenadas = ordenarPalabras($palabras);

    ?>

    <ul>
        <?php foreach ($palabrasOrdenadas as $palabra) { ?>
            <li><?php echo $palabra; ?></li>
        <?php } ?>
    </ul>
</body>

</html>
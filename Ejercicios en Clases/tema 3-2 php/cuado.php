<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    $nombre = $_POST["nombre"];
    $color = $_POST["color"];
    $fondo = $_POST["fondo"];
    ?>
    <style>
        #contenedor{
            width: 300px;
            height: 300px;
            background-color: <?php echo $fondo; ?>;
            color: <?php echo $color; ?>;
            margin: auto;
            text-align: center;
            border: 1px solid black;
        }
    </style>
</head>
<body>
<?php
    $nombre = $_POST["nombre"];
    ?>
    

    <div id="contenedor">
        <?php echo $nombre; ?>

    </div>
</body>
</html>
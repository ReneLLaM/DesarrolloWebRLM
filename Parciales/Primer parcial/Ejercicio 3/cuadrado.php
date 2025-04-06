<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    include('Propiedad.php');
    $item=$_POST['item'];
    $color_fondo=$_POST['color_fondo'];
    $color=$_POST['color'];


    $imagen = "";

    if ($_FILES['imagen']["name"]!="")
    {
        $datosfotografia=explode('.', $_FILES['imagen']['name']);
        $imagen=uniqid().'.'.$datosfotografia[1];
        copy($_FILES['imagen']['tmp_name'],"images/".$imagen);

    }

    $cuadrado = new Propiedad($item, $color, $color_fondo, $imagen);
    $cuadrado->cuadrado();
?>
</body>
</html>
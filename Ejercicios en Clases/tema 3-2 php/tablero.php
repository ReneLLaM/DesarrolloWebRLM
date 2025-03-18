<!DOCTYPE html>
<html lang="ee">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$filas = $_POST["filas"];
$columnas = $_POST["columnas"];

$filaImagen = $_POST["filaImagen"];
$columnaImagen = $_POST["columnaImagen"];

// validaciones que el numero de fila imagen y columna imagen sean menores o iguales que el numero de filas y columnas
if ($filaImagen > $filas || $columnaImagen > $columnas) {
    echo "El numero de fila imagen y columna imagen debe ser menor o igual que el numero de filas y columnas";
    exit;
}
?>
<table>
<?php
for ($i = 1; $i <= $filas; $i++) {
    echo "<tr>";
    for ($j = 1; $j <= $columnas; $j++) {
        // hacer rojo como ajedrez
        if(($i + $j) % 2 == 0){
            echo "<td bgcolor='red'></td>";
        }


        if ($i == $filaImagen && $j == $columnaImagen) {
            echo "<td><img src='imagen.jpg'></td>";
        } else {
            echo "<td></td>";
        }
    }
    echo "</tr>";
}
?>
</table>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
include("Examen.php");
$cadena1 = $_POST['cadena1'];
$cadena2 = $_POST['cadena2'];

$examen = new Examen($cadena1, $cadena2);
$examen->cruzar();
?>
</body>
</html>
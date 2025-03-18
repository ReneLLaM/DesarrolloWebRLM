<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$a = $_GET["a"];
$b = $_GET["b"];
$c = $_GET["c"];

?>
<ul>
    <!-- esto solo se puede mardar por get -->
    <li><a href="calcular.php? $op=sumar" <?php "&a=$a&b=$b&c=$c";?>>sumar</a></li> 
    <li><a href="calcular.php?op=restar&a=$a&b=$b&c=$c">restar</a></li>
    <li><a href="calcular.php?op=multiplicar&a=$a&b=$b&c=$c">multiplicar</a></li>
    <li><a href="calcular.php?op=dividir&a=$a&b=$b&c=$c">dividir</a></li>
</ul>
</body>
</html>




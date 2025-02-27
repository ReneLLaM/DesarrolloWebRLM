<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparar 3 numeros</title>
</head>

<body>

    <?php
    $num1 = 10;
    $num2 = 50;
    $num3 = 30;

    // $arreglo = array($num1, $num2, $num3);
    // sort($arreglo);

    // // Mostrar el el valor mayor del arreglo
    // echo "El valor mayor es: " . $arreglo[2] . "<br>";

    if ($num1 > $num2 && $num1 > $num3) {
        echo "El valor mayor es: " . $num1 . "<br>";
    } else if ($num2 > $num1 && $num2 > $num3) {
        echo "El valor mayor es: " . $num2 . "<br>";
    } else {
        echo "El valor mayor es: " . $num3 . "<br>";
    }
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table{
            margin: 0 auto;
            border-collapse: collapse;
            border-color: green;
            width: 300px;
        }
    </style>
    <title>Ejercicio 2</title>
</head>
<body>
    
    


    <?php 
    $temperatura = $_POST["temperatura"];
    $unidad = $_POST["unidad"];
    
    echo '<table border="1">';
    if ($unidad == "celcius") {
        echo '<tr>';
            echo '<td>kelvin</td>';
            echo '<td>'.$temperatura + 273.15.'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>fahrenheit</td>';
            echo '<td>'.$temperatura * 9/5 + 32 .'</td>';
        echo '</tr>';
    }
    else if ($unidad == "fahrenheit") {
        echo '<tr>';
            echo '<td>celcius</td>';
            echo '<td>'.($temperatura - 32) * 5/9 .'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>kelvin</td>';
            echo '<td>'.($temperatura - 32) * 5/9 + 273.15.'</td>';
        echo '</tr>';
    }
    else if ($unidad == "kelvin") {
        echo '<tr>';
            echo '<td>celcius</td>';
            echo '<td>'.$temperatura - 273.15.'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>fahrenheit</td>';
            echo '<td>'.($temperatura - 273.15) * 9/5 + 32 .'</td>';
        echo '</tr>';
    }
    echo '</table>'
    
    ?>
</body>
</html>
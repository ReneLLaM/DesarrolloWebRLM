<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>
        table{
            border-collapse: collapse;
        }
        td, td, th.titulo, th.encabezado{
            padding: 5px 20px 20px 5px;
            border: 2px solid black;
        }
        th.titulo{
            background-color: #0f4761;
            color:white;
            font-weight: bold;
            width: 30px;
            text-align: left;
        }
        th.encabezado{
            background-color: #dae9f7;
            font-weight: bold;
            width: 30px;
            text-align: left;
        }
        

    </style>
</head>
<body>
    <?php
    $filas = $_GET['filas'];
    $columnas = $_GET['columnas'];
    echo "<table>";
    echo "<tr>";
    for($i=0; $i<=$columnas; $i++){
        if($i==0){
            echo "<th class='titulo'> </th>";
            continue;
        }
        echo "<th class='titulo'>$i</th>";
        
    }
    echo "</tr>";
    for($i=1; $i<=$filas; $i++){
        echo "<tr>";
        for($j=0; $j<=$columnas; $j++){
            if($j==0){
                echo "<th class='encabezado'>$i</th>";
                continue;
            }
            echo "<td>".$i*$j."</td>";
        }
    }
    echo "</table>";
    ?>
</body>
</html>




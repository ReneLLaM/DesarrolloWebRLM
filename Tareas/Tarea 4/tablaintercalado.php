<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
    <style>
        table{
            border-collapse: collapse;
        }
        td{
            padding: 5px 20px 20px 5px;
            border: 2px solid black;
            width: 80px;
            font-family: Arial, sans-serif;
        }
        .rojo{
            background-color: red;
        }
        .amarillo{
            background-color: yellow;
        }
        .verde{
            background-color: green;
        }
    </style>
</head>
<body>
    
    <?php
        $array = ['Viva', 'Mi', 'Bolivia'];
        $filas = $_GET['filas'];
        $columnas = $_GET['columnas'];

        $tamanio = count($array);
        $contador = 0;
        echo "<table border='1'>";
        for($i = 0; $i < $filas; $i++){
            echo "<tr>";
            for($j = 0; $j<$columnas; $j++){
                if($contador == $tamanio){
                    $contador = 0;
                }
                if($j % 2 == 0){
                    echo "<td";
                    if($contador == 0){
                        echo" class = 'rojo'";
                    }else if($contador == 1){
                        echo" class = 'amarillo'";
                    }else if($contador == 2){
                        echo" class = 'verde'";
                    }
                    echo ">" . $array[$contador]. "</td>";
                }
                else{
                    echo "<td";
                    if($contador == 0){
                        echo" class = 'rojo'";
                    }else if($contador == 1){
                        echo" class = 'amarillo'";
                    }else if($contador == 2){
                        echo" class = 'verde'";
                    }
                    echo ">" .($contador + 1). "</td>"; //------------------------------------------para sumar
                }
                    
            }
            $contador++;
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>
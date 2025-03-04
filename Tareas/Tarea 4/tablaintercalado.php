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
            width: 60px;
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
                            echo" style = 'background-color: red;'";
                        }else if($contador == 1){
                            echo" style = 'background-color: yellow;'";
                        }else if($contador == 2){
                            echo" style = 'background-color: green;'";
                        }
                        echo ">" . $array[$contador]. "</td>";
                }
                else{
                    echo "<td";
                    if($contador == 0){
                        echo" style = 'background-color: red;'";
                    }else if($contador == 1){
                        echo" style = 'background-color: yellow;'";
                    }else if($contador == 2){
                        echo" style = 'background-color: green;'";
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
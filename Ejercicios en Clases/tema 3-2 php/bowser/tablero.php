<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php $color = $_GET["color"];?>
    <style>
        tr, td{
            height: 80px;
            width: 120px;
        }

        table{
            border-collapse: collapse;
        }
        .color{
            background-color: <?php echo $color?>;
        }
        .blanco{
            background-color: white;
        }
        .bowser{
            background-color: #FFC000 ;
        }

        img{
            width: 40px;
            height: 40px;
        }
    </style>
</head>
<body>
    <?php
    $numerofilas = $_GET["numerofilas"];
    $numerocolumnas = $_GET["numerocolumnas"];
    $fila = $_GET["fila"];
    $columna = $_GET["columna"];

    if($fila > $numerofilas || $columna > $numerocolumnas){

        // header("Location: tablero.html");
        echo 'las filas o columnas de bowser no deben ser mayores al numero de filas o columnas del tablero';
        exit;
    }
    
    ?>

    
    <table border="1">
    
    <?php 
    for($i=1; $i<=$numerofilas; $i++){
        echo "<tr>";
        for($j=1; $j<=$numerocolumnas; $j++){

            if($i == $fila and $j == $columna){
                echo '<td class="bowser"><img src="images/dino.png" alt=""></td>';
                continue;
            }

            
            if($i%2==1 and $j%2==1){
                echo '<td class="color"></td>';
            }else{
                if($i%2==0 and $j%2==0){
                    echo '<td class="color"></td>';
                }else{
                    echo '<td class="blanco"></td>';
                }
            }
        }
        echo "</tr>";
    }
    ?>


    </table>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td{
            width: 100px;
            height: 15px;
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

        table{
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <?php 
    $filas = $_POST['filas'];
    $columnas = $_POST['columnas'];
    $color = 1;
    ?>
    <table border="1">
        <?php for($i = 1; $i<=$filas; $i++){ ?>
            <?php 
            if($color == 1){
                echo '<tr class="rojo">';
                $color = 2;
            }else if($color == 2){
                echo '<tr class="amarillo">';
                $color++;
            }else{
                echo '<tr class="verde">';
                $color = 1;
            }
            ?>
            <?php for($j = 1; $j<=$columnas; $j++){ ?>
                <td></td>
            <?php }?>
            </tr>
        <?php }?>
    </table>
</body>
</html>
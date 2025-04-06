<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .plomo{
            background-color: #e1e1e1;
        }
        table{
            border-collapse: collapse;
        }
        td{
            width: 30px;
        }
    </style>
</head>

<body>
    <?php
    $filas = $_POST['filas'];
    $columnas = $_POST['columnas'];

    ?>

    <table border="1">
        <?php for ($i = 1; $i <= $filas + 1; $i++) { ?>
            <tr>
                <td class="plomo"><?php if($i != 1) echo $i -1 ?></td>
                <?php for ($j = 1; $j < $columnas + 1; $j++) { ?>
                    <?php if($i==1){?>
                        <td class = "plomo"  > <?php echo $j * $i ?></td>
                    <?php }else{?>
                        <td> <?php echo ($j) * ($i-1) ?></td>
                    <?php } ?>
                <?php } ?>
            </tr>

        <?php } ?>
    </table>
</body>

</html>
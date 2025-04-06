<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        td{
            width: 200px;
            height: 40px;
        }
        .color0{
            background-color: #e0f7fa;
        }
        .color1{
            background-color: #e8f5e9;
        }
        .color2{
            background-color: #fff8e1;
        }
        .color3{
            background-color: #fce4ec;
        }
        .color4{
            background-color: #ede7f6;
        }
        .color5{
            background-color: #e3f2fd;
        }
    </style>
</head>
<body>
    <?php 
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $sexo = $_POST['sexo'];
    $direccion = $_POST['direccion'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];

    $datos = [$nombres,
    $apellidos ,
    $sexo ,
    $direccion ,
    $celular  ,
    $correo];

    $contador = 0

    ?>

    <table border="1">
        <?php for($i = 1; $i<=2; $i++){ ?>
            <tr>
                <?php for($j = 1; $j<=3; $j++){?>
                    <td class="color<?php echo $contador ?>">
                        <?php echo $datos[$contador] ?>
                    </td>
                    <?php $contador++;?>

                <?php }?>
            </tr>

        <?php }?>
    </table>
</body>
</html>
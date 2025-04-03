<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>read</title>
    <link rel="stylesheet" href="styles/read.css">
</head>
<body>
    <?php 
    include("conexion.php");
    
    $sql = "SELECT id, fotografia,nombres,apellidos, cu, sexo, carreras.carrera as carrera FROM alumnos 
    left join carreras on alumnos.codigocarrera=carreras.codigo";
    $resultado = $con->query($sql);

    ?>

    <table style="border-collapse: collapse" border="1" >
        <thead>
            <tr>
                <th>Nro</th>
                <th>Fotografia</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>CU</th>
                <th>Sexo</th>
                <th>Carrera</th>
            </tr>
        </thead>
        <?php $nro = 1;?>
        <?php while($row = $resultado->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $nro++;?></td>
                <td><img src="images/<?php echo $row['fotografia'];  ?>"></td>
                <td><?php echo $row['nombres'];?></td>
                <td><?php echo $row['apellidos'];?></td>
                <td><?php echo $row['cu'];?></td>
                <td><?php if($row['sexo']== "M") echo "Masculino"; else echo "Femenino"; ?></td>
                <td><?php echo $row['carrera'];?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
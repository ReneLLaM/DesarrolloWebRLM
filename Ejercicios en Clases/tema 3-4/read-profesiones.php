<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>leer</title>
    <style>
        td, th{
            border: 1px solid black;
            width: 100px;
        }
    </style>
</head>
<body>
<?php 
include("conexion.php");
$sql = "SELECT id, nombre FROM profesion";
$resultado = $con->query($sql);
?>
<table style="border-collapse: collapse;">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Operaciones</th>
        </tr>


    </thead>
    <?php 
    while($row = mysqli_fetch_array($resultado)){?>
    <tr>
        <td><?php echo $row['nombre']; ?></td>
        <td><a href="form-editar.php?id=<?php echo $row['id']; ?>">Editar</a> <a href="delete.php?id=<?php echo $row['id']; ?>">Eliminar</a></td>
    </tr>
    <?php }?>
</table>
<a href="form-insertar.html">nuevo</a>
</body>
</html>
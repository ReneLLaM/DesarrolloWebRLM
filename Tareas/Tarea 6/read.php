<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/tablas.css">
</head>
<body>
<?php session_start();

require("verificarsesion.php");
include("header.php");

?>
<a href="cerrar.php" class="btn-cerrar">Cerrar Sesion</a>

<?php
include("conexion.php");
$sql="SELECT fotografia,personas.id,nombres,apellidos,fecha_nacimiento,sexo,correo,profesiones.nombre as profesion FROM personas
      LEFT JOIN profesiones ON personas.profesion_id=profesiones.id";  

$resultado=$con->query($sql);

?>
<table style="border-collapse: collapse" border="1" >
    <thead>
        <tr>
            <th width="100px">Fotografia</th>
            <th width="100px">Nombres</th>
            <th width="100px">Apellidos</th>
            <th width="60px">Fec.Nacimiento</th>
            <th width="10px">Sexo</th>
            <th width="150px">Correo</th>
            <th> Profesion</th>
           <?php if($_SESSION['nivel']==1){?>
            <th>Operaciones</th>
            <?php } ?>
        </tr>
    </thead>
    
 <?php 
 while($row=mysqli_fetch_array($resultado)){
    ?>
    <tr>
        <td><img src="images/<?php echo $row['fotografia'];  ?>" width="100px"></td>
        <td><?php echo $row['nombres'];?></td>
        <td><?php echo $row['apellidos'];?></td>
        <td><?php echo $row['fecha_nacimiento'];?></td>
        <td><?php echo $row['sexo'];?></td>
        <td><?php echo $row['correo'];?></td>
        <td><?php echo $row['profesion'];?></td>
        <?php if($_SESSION['nivel']==1){?>
        <td><a href="formeditar.php?id=<?php echo $row['id'];?>">Editar</a>  <a href="delete.php?id=<?php echo $row['id'];?>">Eliminar</a> </td>
        <?php } ?>
    </tr>
    <?php } ?>
 </table>
<?php if($_SESSION['nivel']==1){?>
 <a href="forminsertar.php" class="btn-insertar"> Insertar</a>
 <?php } ?>
 
</body>
</html>
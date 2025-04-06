<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        th{
            background-color: #001f5f;
            color: white;
        }
        tr:nth-child(odd){
            background-color: #dbe4f0;
        }
    </style>
</head>
<body>
<?php session_start();

require("verificarsesion.php");

?>
<a href="cerrar.php">Cerrar Sesion</a>

<?php
include("conexion.php");

$sql="SELECT libros.id,imagen,titulo,autor,editoriales.editorial as editorial,anio FROM libros 
LEFT JOIN editoriales on editoriales.id = libros.id";  

$resultado=$con->query($sql);

?>
<table style="border-collapse: collapse" border="1" >
    <thead>
        <tr>
            <th width="100px">Imagen</th>
            <th width="100px">Titulo</th>
            <th width="100px">Titulo</th>
            <th width="100px">editorial</th>
            <th width="100px">año</th>

           <?php if($_SESSION['nivel']==1){?>
            <th>Operaciones</th>
            <?php } ?>
        </tr>
    </thead>
    
 <?php 
 while($row=mysqli_fetch_array($resultado)){
    ?>
    <tr>
        
        <td><img src="images/<?php echo $row['imagen'];  ?>" width="100px"></td>
        <td><?php echo $row['titulo'];?></td>
        <td><?php echo $row['autor'];?></td>
        <td><?php echo $row['editorial'];?></td>
        <td><?php echo $row['anio'];?></td>
        <?php if($_SESSION['nivel']==1){?>
        <td>  <a href="delete.php?id=<?php echo $row['id'];?>">Eliminar</a> </td>
        <?php } ?>
    </tr>
    <?php } ?>
 </table>
<!-- <?php if($_SESSION['nivel']==1){?>
 <a href="forminsertar.php"> Insertar</a>
 <?php } ?> -->
 
</body>
</html>
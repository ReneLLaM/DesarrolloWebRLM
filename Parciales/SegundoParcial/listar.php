<?php
session_start();
include("conexion.php");


if (!isset($_SESSION['usuario'])) { 
    header("Location:formlogin.html");
}



$sql = "SELECT l.id, l.imagen as fotografia, l.titulo, l.autor,l.anio, e.editorial, u.usuario,c.carrera 
    FROM libros l
    LEFT JOIN editoriales e ON e.id = l.ideditorial
    LEFT JOIN carreras c on c.id = l.idcarrera
    LEFT JOIN usuarios u on u.id = l.idusuario";
    $resultado = $con->query($sql); 
?>


<table style="border-collapse: collapse" border="1" >
    <thead>
        <tr>
            <th >Fotografia</th>
            <th >Titulo</th>
            <th >Autor</th>
            <th >Anio</th>
            <th >Editorial</th>
            <th >Usuario</th>
            <th >Carrera</th>
            <?php if($_SESSION['nivel'] == 1) echo "<th>Operacion</th>"?>
        </tr>
    </thead>
    
 <?php 
 while($row=mysqli_fetch_array($resultado)){
    ?>
    <tr>
        <td><img src="images/<?php echo $row['fotografia'];  ?>" width="50px"></td>
        <td><?php echo $row['titulo'];?></td>
        <td><?php echo $row['autor'];?></td>
        <td><?php echo $row['anio'];?></td>
        <td><?php echo $row['editorial'];?></td>
        <td><?php echo $row['usuario'];?></td>
        <td><?php echo $row['carrera'];?></td>
        <?php if($_SESSION['nivel'] == 1) echo '<td><a href="javascript:editar('.$row['id'].')">editar</a></td>'?>
    </tr>
    <?php } ?>
 </table>




      

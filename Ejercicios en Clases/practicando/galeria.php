<?php

include "conexion.php";
$sql = "SELECT l.imagen, l.titulo, l.autor, l.anio, e.editorial, u.usuario, c.carrera
FROM libros l
INNER JOIN editoriales e ON e.id = l.ideditorial
LEFT JOIN usuarios u ON u.id = l.idusuario
LEFT JOIN carreras c ON c.id = l.idcarrera";

$resultado = $con->query($sql);
?>
<table border="1">
    <tr>
        <th>Imagen</th>
        <th>Titulo</th>
        <th>Autor</th>
        <th>anio</th>
        <th>Editorial</th>
        <th>Usuario</th>
        <th>Carrera</th>
    </tr>

<?php 

while ($row = mysqli_fetch_array($resultado)) {?>
   <tr>
        <td><img style="width: 100px; height: 100px;" src="images/<?php echo $row['imagen'] ?>" alt="<?php echo $row['imagen'] ?>"></td>
        <td><?php echo $row['titulo'] ?></td>
        <td><?php echo $row['autor'] ?></td>
        <td><?php echo $row['anio'] ?></td>
        <td><?php echo $row['editorial'] ?></td>
        <td><?php echo $row['usuario'] ?></td>
        <td><?php echo $row['carrera'] ?></td>
    </tr>
   
<?php } ?>

</table>






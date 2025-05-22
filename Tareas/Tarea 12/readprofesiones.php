<?php session_start();

require("verificarsesion.php");
require("verificarnivel.php");

?>
<a href="cerrar.php">Cerrar Sesion</a>

<?php
include("conexion.php");
$sql="SELECT * FROM profesiones";

$resultado=$con->query($sql);

?>
<table border="1">
    <tr>
        <th>Nombre</th>
        <?php if($_SESSION['nivel']==1){ ?>
        <th>Operaciones</th>
        <?php } ?>
    </tr>
    <?php
    while($row = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nombre'] . "</td>";
        if($_SESSION['nivel']==1){
            echo "<td>";
            echo "<a href='javascript:editarProfesion(" . $row['id'] . ")'>Editar</a> ";
            echo "<a href='javascript:eliminarProfesion(" . $row['id'] . ")'>Eliminar</a>";
            echo "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>
<?php  if($_SESSION['nivel']==1){?>
 <a href="javascript:formInsertarProfesion()">Insertar</a>
 <?php } ?>
 
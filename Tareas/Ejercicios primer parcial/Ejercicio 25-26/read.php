<?php session_start();

require("verificarsesion.php");

?>
<a href="cerrar.php">Cerrar Sesion</a>

<?php
include("conexion.php");

$sql="SELECT idproducto, producto, precio, imagen FROM producto";  

$resultado=$con->query($sql);

?>
<table style="border-collapse: collapse" border="1" >
    <thead>
        <tr>
            <th width="100px">Producto</th>
            <th width="100px">Precio</th>
            <th width="100px">Imagen</th>
           <?php if($_SESSION['nivel']==1){?>
            <th>Operaciones</th>
            <?php } ?>
        </tr>
    </thead>
    
 <?php 
 while($row=mysqli_fetch_array($resultado)){
    ?>
    <tr>
        
        <td><?php echo $row['producto'];?></td>
        <td><?php echo $row['precio'];?></td>
        <td><img src="images/<?php echo $row['imagen'];  ?>" width="100px"></td>
        <?php if($_SESSION['nivel']==1){?>
        <td><a href="formeditar.php?idproducto=<?php echo $row['idproducto'];?>">Editar</a>  <a href="delete.php?idproducto=<?php echo $row['idproducto'];?>">Eliminar</a> </td>
        <?php } ?>
    </tr>
    <?php } ?>
 </table>
<?php if($_SESSION['nivel']==1){?>
 <a href="forminsertar.php"> Insertar</a>
 <?php } ?>
 
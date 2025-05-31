
<?php

include "conexion.php";
$sql = "SELECT id,imagen
FROM libros ;";

$resultado = $con->query($sql);
?>


<?php 

while ($row = mysqli_fetch_array($resultado)) {?>
    <button class="btnimg" onclick="mostrarImagen('images/<?php echo $row['imagen'] ?>')">
   
        <img style="width: 75px; height: 100px;" src="images/<?php echo $row['imagen'] ?>" alt="<?php echo $row['imagen'] ?>"> <div><?php echo $row['imagen'] ?></div>
        
    </button>
   
<?php } ?>








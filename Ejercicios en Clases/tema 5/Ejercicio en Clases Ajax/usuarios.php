<?php include("conexion.php"); 
$sql="SELECT id,nombrecompleto  FROM usuarios";
?>
<option value="0">Seleccione un usuario</option>
<?php
$resultado=$con->query($sql);
while($row=mysqli_fetch_array($resultado)){
    ?>
    <option value="<?php echo $row['id'] ?>"> <?php echo $row['nombrecompleto'];?></option>
    
    <?php } ?>	
<?php include("conexion.php"); 
$sql="SELECT id, carrera FROM carreras";
?>
<option value="0">Seleccione una carrera</option>
<?php
$resultado=$con->query($sql);
while($row=mysqli_fetch_array($resultado)){
    ?>
    <option value="<?php echo $row['id'] ?>"> <?php echo $row['carrera'];?></option>
    
    <?php } ?>	
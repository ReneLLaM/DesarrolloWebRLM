<?php include("conexion.php"); 
$sql="SELECT id,editorial  FROM editoriales";

$resultado=$con->query($sql);
?>
<option value="0">Seleccione una editorial</option>
<?php
while($row=mysqli_fetch_array($resultado)){
    ?>
    <option value="<?php echo $row['id'] ?>"> <?php echo $row['editorial'];?></option>
    
    <?php } ?>	
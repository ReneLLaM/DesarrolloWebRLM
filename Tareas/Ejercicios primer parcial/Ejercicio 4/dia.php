<?php 
$numero = $_GET["numero"];
?>
<select name="dia" >
    <option value="1" <?php if($numero==1) echo "selected" ?>>Lunes</option>
    <option value="1" <?php if($numero==2) echo "selected" ?>>Martes</option>
    <option value="1" <?php if($numero==3) echo "selected" ?>>Miercoles</option>
    <option value="1" <?php if($numero==4) echo "selected" ?>>Jueves</option>
    <option value="1" <?php if($numero==5) echo "selected" ?>>Viernes</option>
    <option value="1" <?php if($numero==6) echo "selected" ?>>Sabado</option>
    <option value="1" <?php if($numero==7) echo "selected" ?>>Domingo</option>
</select>
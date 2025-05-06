<?php
include("conexion.php");
$sql = "SELECT id, nombre FROM departamentos";
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
}
?>

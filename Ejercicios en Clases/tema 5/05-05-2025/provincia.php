<?php 
include("conexion.php");
$id = $_GET['id'];
$sql = "SELECT id, nombre FROM provincia WHERE departamento_id=" . $id;
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
}
?>
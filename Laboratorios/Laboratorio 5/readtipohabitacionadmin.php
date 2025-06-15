<?php session_start();
include("conexion.php");

include("verificarsesion.php");
include("verificarnivel.php");

$sql = "SELECT id, nombre FROM tipo_habitacion";
$result = $con->query($sql);

$objeto = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $objeto[] = $row;
    }
} else {
    $objeto = [];
}
echo json_encode($objeto);
?>

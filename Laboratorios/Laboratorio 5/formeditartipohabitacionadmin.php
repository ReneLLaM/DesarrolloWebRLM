<?php session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");

$id = $_GET['id'];
$stmt = $con->prepare("SELECT id,nombre FROM tipo_habitacion WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$tipohabitacion = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tipohabitacion[] = $row;
    }
    echo json_encode($tipohabitacion);
} else {
    echo json_encode([]);
}
?>
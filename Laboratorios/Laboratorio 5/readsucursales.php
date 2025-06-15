<?php session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");

$stmt = $con->prepare("SELECT id, nombre, direccion, ciudad, telefono, email, activo FROM sucursales"   );
$stmt->execute();

$result = $stmt->get_result();
$sucursales = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sucursales[] = $row;
    }
    echo json_encode($sucursales);
} else {
    echo json_encode([]);
}
?>
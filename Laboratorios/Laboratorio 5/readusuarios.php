<?php session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");

$stmt = $con->prepare("SELECT id,nombre_completo,correo,nivel,activo FROM usuarios WHERE id != ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();

$result = $stmt->get_result();
$usuarios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
    echo json_encode($usuarios);
} else {
    echo json_encode([]);
}
?>
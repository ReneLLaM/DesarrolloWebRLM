<?php 
session_start();
require("verificarsesion.php");
include("conexion.php");

$id = $_GET['id'];

$stmt = $con->prepare('SELECT c.id, u.correo as receptor, u.nombre, c.fecha, c.asunto, c.mensaje, c.leido 
                        FROM correos c
                        INNER JOIN usuarios u ON c.receptor = u.correo
                        WHERE c.id = ? AND c.usuario_id = (SELECT id FROM usuarios WHERE correo = ?) AND c.borrador = 0');
$stmt->bind_param("is", $id, $_SESSION['correo']);
$stmt->execute();

$result = $stmt->get_result();
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        "id" => $row["id"],
        "receptor" => $row["receptor"],
        "nombre" => $row["nombre"],
        "fecha" => $row["fecha"],
        "asunto" => $row["asunto"],
        "mensaje" => $row["mensaje"],
        "leido" => $row["leido"]
    ];
}
echo json_encode($data);
?>
<?php session_start();
require("verificarsesion.php");
include("conexion.php");

$id = $_GET['id'];

$stmt = $con->prepare('UPDATE correos SET leido = 1 WHERE id = ?;');
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt = $con->prepare('SELECT c.id, u.correo as emisor, u.nombre, c.fecha, c.asunto, c.mensaje, c.leido 
                        FROM correos c
                        INNER JOIN usuarios u ON c.usuario_id = u.id
                        WHERE c.id = ?;');
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        "id" => $row["id"],
        "emisor" => $row["emisor"],
        "nombre" => $row["nombre"],
        "fecha" => $row["fecha"],
        "asunto" => $row["asunto"],
        "mensaje" => $row["mensaje"],
        "leido" => $row["leido"]
    ];
}
echo json_encode($data);
?>
<?php 
session_start();
require("verificarsesion.php");
include("conexion.php");

$stmt = $con->prepare('SELECT 
    c.id, 
    c.receptor AS correo_receptor, 
    receptor.nombre AS nombre_receptor, 
    c.fecha, 
    c.asunto, 
    c.mensaje 
FROM correos c
INNER JOIN usuarios emisor ON c.usuario_id = emisor.id
LEFT JOIN usuarios receptor ON c.receptor = receptor.correo
WHERE emisor.correo = ?
    AND c.borrador = 1
ORDER BY c.fecha DESC;');
$stmt->bind_param("s", $_SESSION['correo']);
$stmt->execute();

$result = $stmt->get_result();
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        "id" => $row["id"],
        "receptor" => $row["correo_receptor"],
        "nombre_receptor" => $row["nombre_receptor"],
        "fecha" => $row["fecha"],
        "asunto" => $row["asunto"],
        "mensaje" => $row["mensaje"]
    ];
}
echo json_encode($data);
?>
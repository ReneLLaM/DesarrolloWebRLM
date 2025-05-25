<?php session_start();
require("verificarsesion.php");
include("conexion.php");


$stmt = $con->prepare("SELECT 
    c.id,
    c.receptor AS correo_receptor,
    receptor.nombre AS nombre_receptor,
    c.fecha, 
    c.asunto, 
    c.mensaje, 
    c.leido
FROM correos c
INNER JOIN usuarios emisor ON c.usuario_id = emisor.id
INNER JOIN usuarios receptor ON c.receptor = receptor.correo
WHERE emisor.correo = ?
    AND c.borrador = 0
ORDER BY c.fecha desc;");
$stmt->bind_param("s", $_SESSION['correo']);
$stmt->execute();   

$result = $stmt->get_result();
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        "id" => $row["id"],
        "fecha" => $row["fecha"],
        "asunto" => $row["asunto"],
        "receptor" => $row["correo_receptor"],
        "nombre_receptor" => $row["nombre_receptor"],
        "leido" => $row["leido"],
        "mensaje" => $row["mensaje"]
    ];
}
echo json_encode($data);
?>
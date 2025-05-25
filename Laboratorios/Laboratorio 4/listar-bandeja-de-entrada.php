<?php session_start();
require("verificarsesion.php");
include("conexion.php");


$stmt = $con->prepare('SELECT  
    c.id, 
    emisor.correo AS emisor, 
    emisor.nombre AS nombre_emisor, 
    c.fecha, 
    c.asunto, 
    c.mensaje, 
    c.leido
FROM correos c
INNER JOIN usuarios emisor ON c.usuario_id = emisor.id
WHERE c.receptor = ? 
    AND c.borrador = 0
ORDER BY c.fecha desc;');
$stmt->bind_param("s", $_SESSION['correo']);
$stmt->execute();

$result = $stmt->get_result();
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        "id" => $row["id"],
        "emisor" => $row["emisor"],
        "nombre" => $row["nombre_emisor"],
        "fecha" => $row["fecha"],
        "asunto" => $row["asunto"],
        "mensaje" => $row["mensaje"],
        "leido" => $row["leido"]
    ];
}
echo json_encode($data);
?>

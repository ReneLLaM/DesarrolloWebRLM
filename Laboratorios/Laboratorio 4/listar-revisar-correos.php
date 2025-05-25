<?php 
session_start();
require("verificarsesion.php");
require("verificarnivel.php");
include("conexion.php");


$stmt = $con->prepare("SELECT 
    c.id,
    emisor.correo AS correo_emisor,
    c.receptor AS correo_receptor,
    c.asunto,
    c.fecha,
    c.leido
FROM correos c
INNER JOIN usuarios emisor ON c.usuario_id = emisor.id
WHERE c.borrador = 0
ORDER BY c.fecha DESC;");

$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);

?>
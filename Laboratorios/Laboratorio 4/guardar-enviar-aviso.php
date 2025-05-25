<?php
session_start();
require("verificarsesion.php");
require("verificarnivel.php");
include("conexion.php");

$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];


$sql = "INSERT INTO correos (usuario_id, receptor, asunto, mensaje, leido, borrador)
    SELECT 
        (SELECT id FROM usuarios WHERE correo = ?),
        u.correo,
        ?,
        ?,
        0,
        0
    FROM usuarios u
    WHERE u.correo != ? and u.estado = 1";

$stmt = $con->prepare($sql);
if (!$stmt) {
    throw new Exception("Error preparing statement: " . $con->error);
}

$stmt->bind_param("ssss", $_SESSION["correo"], $asunto, $mensaje, $_SESSION["correo"]);
if (!$stmt->execute()) {
    throw new Exception("Error executing statement: " . $stmt->error);
}

$stmt->close();
echo json_encode(["success" => true]);

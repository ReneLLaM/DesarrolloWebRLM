<?php 
session_start();
require("verificarsesion.php");
include("conexion.php");
require_once("verificarnivel.php");

$correo = $_POST['correo'];
$nombre = $_POST['nombre'];
$nivel = $_POST['nivel'];
$contrasenia = sha1($_POST['password']); 
$estado = 1;

try {
    $stmt = $con->prepare('INSERT INTO usuarios (correo, nombre, nivel, password, estado) VALUES (?, ?, ?, ?, ?)');
    if (!$stmt) {
        throw new Exception("Error preparing statement: " . $con->error);
    }

    $stmt->bind_param("ssisi", $correo, $nombre, $nivel, $contrasenia, $estado);
    if (!$stmt->execute()) {
        throw new Exception("Error executing statement: " . $stmt->error);
    }
    $stmt->close();
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
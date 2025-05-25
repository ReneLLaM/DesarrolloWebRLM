<?php 

session_start();
require_once("verificarsesion.php");
require_once("conexion.php");
require_once("verificarnivel.php");

$correo = $_POST['correo'];
$nombre = $_POST['nombre'];
$nivel = $_POST['nivel'];
$password = $_POST['password'];
$id = $_POST['id'];

try {
    if ($password == "") {
        $stmt = $con->prepare("UPDATE usuarios SET correo = ?, nombre = ?, nivel = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $con->error);
        }
        $stmt->bind_param("sssi", $correo, $nombre, $nivel, $id);
    } else {
        $password = sha1($password); // Encrypt password with SHA1
        $stmt = $con->prepare("UPDATE usuarios SET correo = ?, nombre = ?, nivel = ?, password = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $con->error);
        }
        $stmt->bind_param("ssssi", $correo, $nombre, $nivel, $password, $id);
    }

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
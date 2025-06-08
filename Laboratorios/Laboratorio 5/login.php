<?php
require 'conexion.php';
session_start();

$correo = $_POST['correo'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE correo = ? AND activo = 1";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    // Verificamos con SHA1
    if (sha1($password) === $usuario['password']) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nivel'] = $usuario['nivel'];

        // Redireccionar según el nivel
        if ($usuario['nivel'] === 'Admin') {
            header("Location: admin.php");
        } else {
            header("Location: usuario.php");
        }
        exit();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado o inactivo.";
}
?>

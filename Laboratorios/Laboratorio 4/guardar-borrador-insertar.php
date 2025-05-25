<?php session_start();

require_once("conexion.php");
require_once("verificarsesion.php");

// Obtener el ID del usuario usando el correo en la sesión
$email = $_SESSION['correo']; // Asumiendo que el correo está guardado en la sesión como 'correo'
$stmt_user = $con->prepare("SELECT id FROM usuarios WHERE correo = ?");
$stmt_user->bind_param("s", $email);
$stmt_user->execute();
$stmt_user->bind_result($id_usuario);
$stmt_user->fetch();
$stmt_user->close();

$para = $_POST['para'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

$stmt = $con->prepare("INSERT INTO correos (usuario_id, receptor, asunto, mensaje, fecha, borrador) VALUES (?, ?, ?, ?, NOW(), 1)");
$stmt->bind_param("isss", $id_usuario, $para, $asunto, $mensaje);
$stmt->execute();
$stmt->close();

?>
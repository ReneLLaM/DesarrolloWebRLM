<?php session_start();

require_once("conexion.php");
require_once("verificarsesion.php");

$email = $_SESSION['correo']; 
$stmt_user = $con->prepare("SELECT id FROM usuarios WHERE correo = ?");
$stmt_user->bind_param("s", $email);
$stmt_user->execute();
$stmt_user->bind_result($id_usuario);
$stmt_user->fetch();
$stmt_user->close();

$para = $_POST['para'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

$stmt = $con->prepare("INSERT INTO correos (usuario_id, receptor, asunto, mensaje, fecha, borrador) VALUES (?, ?, ?, ?, NOW(), 0)");
$stmt->bind_param("isss", $id_usuario, $para, $asunto, $mensaje);
$stmt->execute();
$stmt->close();

?>
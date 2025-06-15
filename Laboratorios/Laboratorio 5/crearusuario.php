<?php 
session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");

$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$nivel = $_POST['nivel'];
$activo = $_POST['activo'];
$password = sha1($_POST['password']);
$telefono = $_POST['telefono'];

$stmt = $con->prepare("INSERT INTO usuarios (nombre_completo, correo, password, nivel, activo, telefono) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiis", $nombre_completo, $correo, $password, $nivel, $activo, $telefono);
$stmt->execute();

$stmt->close();
$con->close();
?>
<?php 
session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");

$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$activo = $_POST['activo'];

$stmt = $con->prepare("INSERT INTO sucursales (nombre, direccion, ciudad, telefono, email, activo) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiis", $nombre, $direccion, $ciudad, $telefono, $email, $activo);
$stmt->execute();

$stmt->close();
$con->close();
?>
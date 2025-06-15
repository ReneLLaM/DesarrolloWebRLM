<?php 
session_start();
include("conexion.php");
include("verificarnivel.php");

$nombre = $_POST['nombre'];

$stmt = $con->prepare("INSERT INTO tipo_habitacion (nombre) VALUES (?)");
$stmt->bind_param("s", $nombre);
$stmt->execute();

$stmt->close();
$con->close();
?>
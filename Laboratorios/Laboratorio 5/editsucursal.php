<?php
session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$activo = $_POST['activo'];

if ($_POST['activo'] == "1") {
    $stmt = $con->prepare("UPDATE sucursales SET nombre = ?, direccion = ?, ciudad = ?, telefono = ?, email = ?, activo = ? WHERE id = ?");
    $stmt->bind_param("sssisii", $nombre, $direccion, $ciudad, $telefono, $email, $activo, $id);
} else {
    $stmt = $con->prepare("UPDATE sucursales SET nombre = ?, direccion = ?, ciudad = ?, telefono = ?, email = ?, activo = ? WHERE id = ?");
    $stmt->bind_param("sssisii", $nombre, $direccion, $ciudad, $telefono, $email, $activo, $id);
}


$stmt->execute();

$stmt->close();
$con->close();

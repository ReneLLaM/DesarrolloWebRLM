<?php
session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");
$id = $_POST['id'];
$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$nivel = $_POST['nivel'];
$activo = $_POST['activo'];
$telefono = $_POST['telefono'];

if ($_POST['password'] != "") {
    $password = sha1($_POST['password']);
    $stmt = $con->prepare("UPDATE usuarios SET nombre_completo = ?, correo = ?, password = ?, nivel = ?, activo = ?, telefono = ? WHERE id = ?");
    $stmt->bind_param("sssiisi", $nombre_completo, $correo, $password, $nivel, $activo, $telefono, $id);
} else {
    $stmt = $con->prepare("UPDATE usuarios SET nombre_completo = ?, correo = ?, nivel = ?, activo = ?, telefono = ? WHERE id = ?");
    $stmt->bind_param("ssiiis", $nombre_completo, $correo, $nivel, $activo, $telefono, $id);
}


$stmt->execute();

$stmt->close();
$con->close();

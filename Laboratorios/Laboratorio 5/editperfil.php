<?php
session_start();
include("conexion.php");

$id = $_POST['id'];
$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$telefono = $_POST['telefono'];

if ($_POST['password'] != "") {
    $password = sha1($_POST['password']);
    $stmt = $con->prepare("UPDATE usuarios SET nombre_completo = ?, correo = ?, password = ?, telefono = ? WHERE id = ?");
    $stmt->bind_param("sssii", $nombre_completo, $correo, $password, $telefono, $id);
} else {
    $stmt = $con->prepare("UPDATE usuarios SET nombre_completo = ?, correo = ?, telefono = ? WHERE id = ?");
    $stmt->bind_param("ssii", $nombre_completo, $correo, $telefono, $id);
}

$stmt->execute();

// Actualizar la sesión con los nuevos datos
$_SESSION['nombre'] = $nombre_completo;
$_SESSION['correo'] = $correo;
$_SESSION['password'] = $password;
$_SESSION['telefono'] = $telefono;

$stmt->close(); 
$con->close();


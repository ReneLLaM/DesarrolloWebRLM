<?php session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");

$id = $_GET['id'];
$stmt = $con->prepare("UPDATE sucursales SET activo = CASE WHEN activo = 1 THEN 0 ELSE 1 END WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$con->close();
?>
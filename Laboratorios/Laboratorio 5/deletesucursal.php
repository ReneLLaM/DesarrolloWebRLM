<?php 
session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");

$id = $_GET['id'];
$stmt = $con->prepare("DELETE FROM sucursales WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$con->close();
?>
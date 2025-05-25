<?php 
session_start();
require("verificarsesion.php");
include("conexion.php");

$id = $_GET['id'];

$stmt = $con->prepare('DELETE FROM correos WHERE id = ? AND usuario_id = (SELECT id FROM usuarios WHERE correo = ?);');
$stmt->bind_param("is", $id, $_SESSION['correo']);
$stmt->execute();

$con->close();
?>
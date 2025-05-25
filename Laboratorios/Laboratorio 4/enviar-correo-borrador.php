<?php 
session_start();
require("verificarsesion.php");
include("conexion.php");

$id = $_POST['id'];
$para = $_POST['para'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

$stmt = $con->prepare('UPDATE correos SET receptor = ?, asunto = ?, mensaje = ? , borrador = 0, fecha = NOW() WHERE id = ?');
$stmt->bind_param("sssi", $para, $asunto, $mensaje, $id);
$stmt->execute();

?>
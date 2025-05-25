<?php
session_start();
require("verificarsesion.php");
include("conexion.php");

$id = $_GET['id'];

$stmt = $con->prepare('UPDATE correos 
SET borrador = 0, fecha = CURRENT_TIMESTAMP 
WHERE id = ?;');
$stmt->bind_param("i", $id);
$stmt->execute();

$con->close();

?>


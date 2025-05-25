<?php 
session_start();
require("verificarsesion.php");
include("conexion.php");

$id = $_GET['id'];

$stmt = $con->prepare('DELETE FROM correos WHERE id = ?;');
$stmt->bind_param("i", $id);
$stmt->execute();

$con->close();

?>
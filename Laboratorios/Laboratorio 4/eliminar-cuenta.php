<?php 
session_start();
require("verificarsesion.php");
require("conexion.php");

$id = $_GET['id'];


$sql = $con->prepare("DELETE FROM usuarios WHERE id = ? and correo != ?");
$sql->bind_param("is", $id, $_SESSION['correo']);
$sql->execute();

?>
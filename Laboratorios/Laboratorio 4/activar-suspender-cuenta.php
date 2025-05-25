<?php 
session_start();
require("verificarsesion.php");
require("conexion.php");

$id = $_GET['id'];

$sql = $con->prepare("UPDATE usuarios SET estado = CASE WHEN estado = 1 THEN 0 ELSE 1 END WHERE id = ? and correo != ?");
$sql->bind_param("is", $id, $_SESSION["correo"]);
$sql->execute();


?>
<?php 
session_start();
include("conexion.php");
include("verificarnivel.php");

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];

    $stmt = $con->prepare("UPDATE tipo_habitacion SET nombre = ? WHERE id = ?");
    $stmt->bind_param("si", $nombre, $id);
    $stmt->execute();
    
?>
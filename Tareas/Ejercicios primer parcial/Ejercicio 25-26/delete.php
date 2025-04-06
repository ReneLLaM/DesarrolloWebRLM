<?php session_start();
include("conexion.php");
require("verificarsesion.php");
require("verificarnivel.php");

$idproducto=$_GET['idproducto'];
//$sql="DELETE FROM personas WHERE id=$id";

$stmt=$con->prepare('DELETE FROM producto WHERE idproducto=?');
$stmt->bind_param("i",$idproducto);
// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro Eliminado";
} else {
    echo "Error: " . $stmt->error;
}

$con->close();
?>
<meta http-equiv="refresh" content="3;url=read.php">

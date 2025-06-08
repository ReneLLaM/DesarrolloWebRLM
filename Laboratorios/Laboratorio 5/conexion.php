<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "hotel_reservas";

$conexion = new mysqli($host, $usuario, $contrasena, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

<?php
session_start();
require("verificarsesion.php");
require("conexion.php");
require_once("verificarnivel.php");


$sql = $con->prepare("SELECT id, correo, nombre, nivel, estado FROM usuarios");
$sql->execute();
$resultado = $sql->get_result();

if ($resultado) {
    $data = array();
    while ($row = $resultado->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(array("error" => "Error al obtener los usuarios"));
}

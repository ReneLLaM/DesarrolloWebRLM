<?php 
include("conexion.php");
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];
$sexo = $_POST["sexo"];
$correo_electronico = $_POST["correo_electronico"];

$stmt = $con->prepare("INSERT INTO personas (nombres, apellidos, fecha_nacimiento, sexo, correo_electronico) VALUES (?,?,?,?,?)");
$stmt->bind_param("sssss", $nombres, $apellidos, $fecha_nacimiento, $sexo, $correo_electronico);
$con->execute();
$con->close();


?>

    <meta http-equiv="refresh" content="0; url=read.php">
    <h1>Registro Guardado</h1>
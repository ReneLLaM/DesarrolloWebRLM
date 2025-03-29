<?php 
include("conexion.php");

$id = $_POST["id"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$correo = $_POST["correo"];


$stmt = $con->prepare("UPDATE usuarios SET nombres=?, apellidos=?, correo=? WHERE id=?");
$stmt->bind_param("sssi", $nombres, $apellidos, $correo, $id);

if ($stmt->execute()) {
    echo "Registro Actualizado";
} else {
    echo "Error: " . $stmt->error;
}
?>

<meta http-equiv="refresh" content="3;url=pregunta4.php">
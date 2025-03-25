<?php 
include("conexion.php");
$correo = $_POST["correo"];
$password = sha1($_POST["password"]);

$stmt = $conexion->prepare("SELECT correo, nombre, nivel FROM usuarios WHERE correo = ? AND password = ?");
$stmt->bind_param("ss", $correo, $password);

if ($stmt->execute()) {
    echo "Consulta exitosa";
} else {
    echo "Error en la consulta";
    echo '<meta http-equiv="refresh" content="0; url=formLogin.php">';
}
?>
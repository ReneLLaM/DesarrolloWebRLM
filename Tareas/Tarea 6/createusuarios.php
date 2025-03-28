<?php session_start();
include("conexion.php");
require("verificarsesion.php");
require("verificarnivel.php");

$correo=$_POST['correo'];
$nombre=$_POST['nombre'];
$contrasenia=$_POST['contrasenia'];
$nivel=$_POST['nivel'];

//$sql="INSERT INTO personas(nombres,apellidos,fecha_nacimiento,sexo,correo) VALUES('$nombres','$apellidos','$fecha_nacimiento','$sexo','$correo')";


$stmt=$con->prepare('INSERT INTO usuarios(correo,nombre,password,nivel) VALUES(?,?,?,?)');

// Vincular parámetros
$stmt->bind_param("sssi",$correo,$nombre,$contrasenia,$nivel);



// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Nuevo registro creado con éxito";
} else {
    echo "Error: " . $stmt->error;
}

$con->close();
?>
<meta http-equiv="refresh" content="3;url=readusuarios.php">

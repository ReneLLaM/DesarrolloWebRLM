<?php session_start();
include("conexion.php");
require("verificarsesion.php");
require("verificarnivel.php");

$correo = $_POST['correo'];
$nombre = $_POST['nombre'];
$contraseniaAnterior = sha1($_POST['contrasenia-anterior']);
$password = sha1($_POST['contrasenia']);
$nivel = $_POST['nivel'];
$id = $_POST['id'];

//$sql="UPDATE personas SET nombres='$nombres',apellidos='$apellidos',fecha_nacimiento='$fecha_nacimiento',sexo='$sexo',correo='$correo' WHERE id=$id";
$sql = "SELECT password FROM usuarios WHERE id=$id";
$resultado = $con->query($sql);
$row = $resultado->fetch_assoc();

if ($contraseniaAnterior == $row['password']) {
    $stmt = $con->prepare('UPDATE usuarios SET correo=?,nombre=?,password=?,nivel=? WHERE id=?');


    // Vincular parámetros
    $stmt->bind_param("ssssi", $correo, $nombre, $password, $nivel,  $id);



    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro Actualizado";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Contraseña anterior incorrecta";
}

$con->close();
?>
<meta http-equiv="refresh" content="3;url=readusuarios.php">
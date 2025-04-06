<?php session_start();
include("conexion.php");
require("verificarsesion.php");
require("verificarnivel.php");


$producto=$_POST['producto'];
$precio=$_POST['precio'];


$imagen = "";

if ($_FILES['imagen']["name"]!="")
{
    $datosfotografia=explode('.', $_FILES['imagen']['name']);
    $imagen=uniqid().'.'.$datosfotografia[1];
    copy($_FILES['imagen']['tmp_name'],"images/".$imagen);

}



//$sql="INSERT INTO personas(nombres,apellidos,fecha_nacimiento,sexo,correo) VALUES('$nombres','$apellidos','$fecha_nacimiento','$sexo','$correo')";


$stmt=$con->prepare('INSERT INTO producto(producto,precio,imagen) VALUES(?,?,?)');

// Vincular parámetros
$stmt->bind_param("sss", $producto, $precio, $imagen);



// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Nuevo registro creado con éxito";
} else {
    echo "Error: " . $stmt->error;
}

$con->close();
?>
<meta http-equiv="refresh" content="3;url=read.php">

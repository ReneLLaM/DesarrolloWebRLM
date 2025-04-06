<?php  session_start();
include("conexion.php");
require("verificarsesion.php");
require("verificarnivel.php");

$idproducto = $_POST['idproducto'];
$producto = $_POST['producto'];
$precio = $_POST['precio'];



//$sql="UPDATE personas SET nombres='$nombres',apellidos='$apellidos',fecha_nacimiento='$fecha_nacimiento',sexo='$sexo',correo='$correo' WHERE id=$id";
$imagen = "";

if ($_FILES['imagen']["name"]!="")
{
    
    $datosfotografia=explode('.', $_FILES['imagen']['name']);
    $imagen=uniqid().'.'.$datosfotografia[1];
    copy($_FILES['imagen']['tmp_name'],"images/".$imagen);

    $stmt=$con->prepare('UPDATE producto SET producto=?,precio=?,imagen=? WHERE idproducto=?');


// Vincular parámetros
    $stmt->bind_param("sisi",$producto,$precio,$imagen,$idproducto);
}else{
    $stmt=$con->prepare('UPDATE producto SET producto = ?, precio=? WHERE idproducto=?');

    // Vincular parámetros
    $stmt->bind_param("sii", $producto, $precio, $idproducto);
}





// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro Actualizado";
} else {
    echo "Error: " . $stmt->error;
}

$con->close();
?>
<meta http-equiv="refresh" content="3;url=read.php">

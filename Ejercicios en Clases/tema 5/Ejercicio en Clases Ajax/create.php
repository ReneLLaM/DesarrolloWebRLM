<?php 
include("conexion.php");



$titulo=$_POST['titulo'];
$autor=$_POST['autor'];
$editorial=$_POST['editorial'];
$anio=$_POST['anio'];
$usuario=$_POST['usuario'];
$carrera=$_POST['carrera'];

$fotografia = "";

if ($_FILES['fotografia']["name"]!="")
{
    $datosfotografia=explode('.', $_FILES['fotografia']['name']);
    $fotografia=uniqid().'.'.$datosfotografia[1];
    copy($_FILES['fotografia']['tmp_name'],"images/".$fotografia);

}



//$sql="INSERT INTO personas(nombres,apellidos,fecha_nacimiento,sexo,correo) VALUES('$nombres','$apellidos','$fecha_nacimiento','$sexo','$correo')";


$stmt=$con->prepare('INSERT INTO libros(imagen,titulo,autor,ideditorial,anio,idusuario,idcarrera) VALUES(?,?,?,?,?,?,?)');

// Vincular parámetros
$stmt->bind_param("sssisii",$fotografia,$titulo, $autor,$editorial,$anio,$usuario, $carrera);



// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Libro guardado exitosamente";
} else {
    echo "Error: " . $stmt->error;
}

$con->close();
?>


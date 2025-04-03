<?php
include("conexion.php");

$numero = $_POST['numero'];
for ($i = 0; $i < $numero; $i++) {
    $fotografia = "";
    if (isset($_FILES['fotografia' . $i + 1])) {
        $datosfotografia = explode('.', $_FILES['fotografia' . $i + 1]['name']);
        $fotografia = uniqid() . '.' . $datosfotografia[1];
        copy($_FILES['fotografia' . $i + 1]['tmp_name'], "images/" . $fotografia);
    }
    $nombres = $_POST['nombre' . $i + 1];
    $apellidos = $_POST['apellido' . $i + 1];
    $cu = $_POST['CU' . $i + 1];
    $sexo = $_POST['sexo' . $i + 1];
    $carrera = $_POST['carrera' . $i + 1];
    $stmt = $con->prepare('INSERT INTO alumnos(fotografia,nombres,apellidos,cu,sexo,codigocarrera) VALUES(?,?,?,?,?,?)');
    $stmt->bind_param("sssssi", $fotografia, $nombres, $apellidos, $cu, $sexo, $carrera);
    $stmt->execute();
    if ($stmt->error) {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
echo "Registros Guardados";

$con->close();
?>
<meta http-equiv="refresh" content="3;url=read.php">

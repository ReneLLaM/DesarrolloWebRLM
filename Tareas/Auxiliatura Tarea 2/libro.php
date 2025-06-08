<?php

include "conexion.php";

$id = $_GET['id'];

$sql = "SELECT l.imagen, l.titulo, l.autor, l.anio, e.editorial FROM libros l LEFT JOIN editoriales e ON e.id = l.ideditorial WHERE l.id = $id";

$sql = $con->prepare($sql);
$sql->execute();

$result = $sql->get_result();

$result = $result->fetch_assoc();
echo json_encode($result);

?>

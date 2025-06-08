<?php

include "conexion.php";

$prompt = $_GET['prompt'];

// $books = [
//     'El señor de los anillos',
//     'Harry Potter',
//     'Cien años de soledad',
//     'El principito',
// ];

$sql = "SELECT l.id, l.imagen, l.titulo, l.autor, l.anio, e.editorial
FROM libros l
LEFT JOIN editoriales e ON e.id = l.ideditorial
WHERE UPPER(CONCAT(l.titulo, l.autor, l.anio, e.editorial)) LIKE UPPER('%".$prompt."%');";

$sql = $con->prepare($sql);
$sql->execute();

$result = $sql->get_result();

$results = [];

while ($row = $result->fetch_assoc()) {
    $results[] = $row;
}

echo json_encode($results);

?>

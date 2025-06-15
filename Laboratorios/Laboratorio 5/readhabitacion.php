<?php 
include("conexion.php");
$id = $_GET['id'];

$query = "SELECT s.nombre as nombresucursal, s.direccion, s.ciudad, s.telefono, s.email,
h.id, h.nombre as nombrehabitacion, h.numero, h.piso, h.precio, h.superficie, h.nro_camas, h.capacidad_maxima, h.descripcion,
t.nombre as nombretipohabitacion
FROM habitaciones h
LEFT JOIN tipo_habitacion t ON t.id = h.tipo_habitacion_id
LEFT JOIN sucursales s ON s.id = h.sucursal_id
WHERE h.id = $id";

$query2 = "SELECT id, nombre, fotografia, tipo 
           FROM fotografias_habitacion
           WHERE habitacion_id = $id
           ORDER BY orden ASC";

$result = $con->query($query);
$roomData = $result->fetch_assoc();

$result2 = $con->query($query2);
$photos = [];
while ($row = $result2->fetch_assoc()) {
    $photos[] = $row;
}

$response = [
    'habitacion' => $roomData,
    'fotografias' => $photos
];

header('Content-Type: application/json');
echo json_encode($response);
?>
<?php 
include("conexion.php");

$id = $_GET['id'];

$query = "SELECT r.id, r.fecha_reserva, r.fecha_ingreso, r.fecha_salida, r.precio_total, r.estado, u.nombre_completo as cliente, h.numero as numero_habitacion, s.nombre as sucursal FROM reservas r LEFT JOIN usuarios u ON r.usuario_id = u.id LEFT JOIN habitaciones h ON r.habitacion_id = h.id LEFT JOIN sucursales s ON h.sucursal_id = s.id WHERE r.id = $id";

$result = $con->query($query);
$reserva = $result->fetch_assoc();

$response = [
    'reserva' => $reserva,
];

header('Content-Type: application/json');
echo json_encode($response);
?>
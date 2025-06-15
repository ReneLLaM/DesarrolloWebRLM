<?php session_start();
include("verificarsesion.php");
include("verificarnivel.php");
include("conexion.php");

header('Content-Type: application/json; charset=utf-8');

$con->set_charset("utf8");

$sql = "SELECT
            r.id,
            r.fecha_reserva,
            r.fecha_ingreso,
            r.fecha_salida,
            r.precio_total,
            r.estado               AS estado_reserva,
            u.nombre_completo      AS cliente,
            h.numero               AS numero_habitacion,
            s.nombre               AS sucursal
        FROM reservas r
        LEFT JOIN usuarios u    ON r.usuario_id   = u.id
        LEFT JOIN habitaciones h ON r.habitacion_id = h.id
        LEFT JOIN sucursales s   ON h.sucursal_id  = s.id
        ORDER BY r.fecha_reserva DESC";

$result = $con->query($sql);
if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => $con->error]);
    exit;
}

$reservas = [];
while ($row = $result->fetch_assoc()) {
    $reservas[] = [
        'id'            => $row['id'],
        'fecha_reserva' => $row['fecha_reserva'],
        'cliente'       => $row['cliente'] ?: 'N/D',
        'habitacion'    => $row['numero_habitacion'] ?: 'N/D',
        'sucursal'      => $row['sucursal'] ?: 'N/D',
        'ingreso'       => $row['fecha_ingreso'],
        'salida'        => $row['fecha_salida'],
        'precio_total'  => (float)$row['precio_total'],
        'estado'        => $row['estado_reserva'] ? 'pagada' : 'pendiente'
    ];
}

echo json_encode($reservas);

?>
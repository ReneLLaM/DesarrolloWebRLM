<?php
include_once("conexion.php");
header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID de reserva requerido']);
    exit;
}
$reservaId = intval($_GET['id']);

$con->set_charset("utf8");

$sql = "SELECT  r.id                 AS reserva_id,
                r.fecha_reserva,
                r.fecha_ingreso,
                r.fecha_salida,
                r.estado,                    -- 0 = pendiente, 1 = pagado
                r.precio_total,
                r.usuario_id,               -- Add user ID
                u.nombre_completo    AS nombre_usuario,  -- Updated to use nombre_completo
                h.id                 AS habitacion_id,
                h.nombre             AS nombrehabitacion,
                h.numero,
                h.piso,
                h.precio,
                h.superficie,
                h.nro_camas,
                h.capacidad_maxima,
                h.descripcion,
                t.nombre             AS nombretipohabitacion,
                s.nombre             AS nombresucursal,
                s.direccion,
                s.ciudad,
                s.telefono,
                s.email
        FROM reservas r
        JOIN habitaciones h      ON r.habitacion_id   = h.id
        LEFT JOIN tipo_habitacion t ON t.id            = h.tipo_habitacion_id
        LEFT JOIN sucursales s      ON s.id            = h.sucursal_id
        LEFT JOIN usuarios u        ON u.id            = r.usuario_id  -- Join with usuarios table
       WHERE r.id = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $reservaId);
$stmt->execute();
$result = $stmt->get_result();
$roomData = $result->fetch_assoc();

if (!$roomData) {
    http_response_code(404);
    echo json_encode(['error' => 'Reserva no encontrada']);
    exit;
}

$habId = $roomData['habitacion_id'];
$sqlFotos = "SELECT id, nombre, fotografia, tipo
               FROM fotografias_habitacion
              WHERE habitacion_id = ?
           ORDER BY orden ASC";
$stmtFotos = $con->prepare($sqlFotos);
$stmtFotos->bind_param("i", $habId);
$stmtFotos->execute();
$fotosRes = $stmtFotos->get_result();

$fotografias = [];
while ($row = $fotosRes->fetch_assoc()) {
    $fotografias[] = $row;
}

$response = [
    'habitacion'  => $roomData,
    'fotografias' => $fotografias
];

echo json_encode($response);

$stmt->close();
$stmtFotos->close();
$con->close();
?>
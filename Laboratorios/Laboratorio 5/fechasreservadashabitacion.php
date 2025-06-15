<?php
include 'conexion.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$rangos = [];
if ($id) {
    $stmt = $con->prepare(
        "SELECT fecha_ingreso, fecha_salida
           FROM reservas
          WHERE habitacion_id = ? AND estado = 1"
    );
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        // formato que entiende Flatpickr
        $rangos[] = [
            'from' => $row['fecha_ingreso'],
            'to'   => $row['fecha_salida']
        ];
    }
    $stmt->close();
}
header('Content-Type: application/json');
echo json_encode($rangos);
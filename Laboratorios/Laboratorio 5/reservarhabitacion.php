<?php
include "conexion.php";
session_start();

$habitacion_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$fecha_ingreso  = $_POST['fechaEntrada'] ?? '';
$fecha_salida   = $_POST['fechaSalida'] ?? '';
$precio_total   = $_POST['precioTotal'] ?? 0;
$huespedes      = isset($_POST['huespedes']) ? intval($_POST['huespedes']) : 0;
$dias           = $_POST['dias'] ?? 0;

if (!$habitacion_id || !$fecha_ingreso || !$fecha_salida || !$precio_total || $huespedes < 1) {
    echo "error";
    exit;
}

if ($huespedes < 1 || $huespedes > 10) {
    echo "error_huéspedes";
    exit;
}

// Validar fechas
$fecha_actual = date('Y-m-d');
if ($fecha_ingreso < $fecha_actual || $fecha_salida <= $fecha_ingreso) {
    echo "error_fechas";
    exit;
}

$fecha_reserva = date('Y-m-d H:i:s');
$usuario_id = (!empty($_POST['idUsuario'])) ? intval($_POST['idUsuario']) : $_SESSION['id'];

header('Content-Type: text/plain');

try {
    // Verificar disponibilidad de la habitación para las fechas seleccionadas
    $stmt = $con->prepare("SELECT id FROM reservas 
                         WHERE habitacion_id = ? 
                         AND estado = 0 
                         AND ((fecha_ingreso BETWEEN ? AND DATE_SUB(?, INTERVAL 1 DAY)) 
                         OR (fecha_salida > ? AND fecha_ingreso < ?))");
    $stmt->bind_param("issss", $habitacion_id, $fecha_ingreso, $fecha_salida, $fecha_ingreso, $fecha_salida);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "ocupada";
        exit;
    }
    $stmt->close();

    // Insertar la reserva
    if ($usuario_id) {
        $stmt = $con->prepare("INSERT INTO reservas (usuario_id, habitacion_id, fecha_reserva, fecha_ingreso, fecha_salida, huespedes, precio_total, estado) VALUES (?,?,?,?,?,?,?,0)");
        $stmt->bind_param("iisssid", $usuario_id, $habitacion_id, $fecha_reserva, $fecha_ingreso, $fecha_salida, $huespedes, $precio_total);
    } else {
        $stmt = $con->prepare("INSERT INTO reservas (usuario_id, habitacion_id, fecha_reserva, fecha_ingreso, fecha_salida, huespedes, precio_total, estado) VALUES (NULL,?,?,?,?,?,?,0)");
        $stmt->bind_param("isssid", $habitacion_id, $fecha_reserva, $fecha_ingreso, $fecha_salida, $huespedes, $precio_total);
    }

    if ($stmt->execute()) {
        $reserva_id = $con->insert_id;
        echo $reserva_id;
    } else {
        throw new Exception($stmt->error);
    }
    $stmt->close();
} catch (Exception $e) {
    error_log("Error en reservarhabitacion.php: " . $e->getMessage());
    echo "error";
}
?>
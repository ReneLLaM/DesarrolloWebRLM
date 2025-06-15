<?php
include "conexion.php";
header('Content-Type: application/json');

$reserva_id  = isset($_POST['reserva_id']) ? intval($_POST['reserva_id']) : 0;
$monto       = 0;
$metodo_pago = $_POST['metodo'] ?? 'tarjeta-simulada';

if (!$reserva_id) {
    echo json_encode(['success' => false, 'error' => 'ID de reserva faltante']);
    exit;
}

$montoStmt = $con->prepare("SELECT precio_total FROM reservas WHERE id = ? AND estado = 0");
$montoStmt->bind_param("i", $reserva_id);
$montoStmt->execute();
$montoRes = $montoStmt->get_result();

if ($montoRes->num_rows === 0) {
    echo json_encode(['success' => false, 'error' => 'La reserva no existe o ya fue pagada']);
    exit;
}
$row   = $montoRes->fetch_assoc();
$monto = floatval($row['precio_total']);
mysqli_free_result($montoRes);

$referencia = uniqid('PAY');

$con->begin_transaction();

try {
    $check = $con->prepare("SELECT id FROM reservas WHERE id = ? AND estado = 0");
    $check->bind_param("i", $reserva_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows === 0) {
        throw new Exception("La reserva no existe o ya fue pagada");
    }

    $pago = $con->prepare(
        "INSERT INTO pagos (reserva_id, monto, metodo_pago, estado, referencia, fecha_pago)
         VALUES (?, ?, ?, 1, ?, NOW())"
    );
    if (!$pago) {
        throw new Exception("Error al preparar la consulta de pago: " . $con->error);
    }
    $pago->bind_param("idss", $reserva_id, $monto, $metodo_pago, $referencia);
    if (!$pago->execute()) {
        throw new Exception("Error al ejecutar el pago: " . $pago->error);
    }

    $up = $con->prepare("UPDATE reservas SET estado = 1 WHERE id = ?");
    $up->bind_param("i", $reserva_id);
    if (!$up->execute()) {
        throw new Exception("Error al actualizar la reserva: " . $up->error);
    }

    $con->commit();

    echo json_encode([
        'success'   => true,
        'message'   => 'Pago procesado correctamente',
        'referencia'=> $referencia
    ]);

} catch (Exception $e) {
    $con->rollback();
    error_log("Error en crearpago.php - " . $e->getMessage());
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
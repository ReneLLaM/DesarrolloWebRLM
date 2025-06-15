<?php
include "conexion.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$reserva_id = isset($_POST['reserva_id']) ? intval($_POST['reserva_id']) : 0;

if ($reserva_id <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ID de reserva no válido']);
    exit;
}

try {
    $stmt = $con->prepare("SELECT id FROM reservas WHERE id = ? AND estado = 0");
    $stmt->bind_param("i", $reserva_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception("Reserva no encontrada o ya procesada");
    }

    $del = $con->prepare("DELETE FROM reservas WHERE id = ?");
    $del->bind_param("i", $reserva_id);
    $del->execute();

    if ($del->affected_rows === 0) {
        throw new Exception("No se pudo cancelar la reserva");
    }

    echo json_encode(['success' => true, 'message' => 'Reserva cancelada con éxito']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al cancelar la reserva: ' . $e->getMessage()]);
}

$con->close();
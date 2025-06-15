<?php session_start();

getReservasUser($_GET['id']);

function getReservasUser($id) {
    include_once("conexion.php");
    if ($con->connect_error) {
        http_response_code(500);
        die(json_encode(["error" => "Connection failed: " . $con->connect_error]));
    }
    $con->set_charset("utf8");

    $sql = "SELECT r.id              AS reserva_id,
                   r.fecha_reserva    AS fecha_reserva,
                   r.fecha_ingreso    AS fecha_ingreso,
                   r.fecha_salida     AS fecha_salida,
                   r.estado           AS estado,
                   h.nombre           AS habitacion_nombre,
                   h.numero           AS habitacion_numero,
                   h.precio           AS precio,
                   (SELECT fh.fotografia
                      FROM fotografias_habitacion fh
                     WHERE fh.habitacion_id = h.id
                       AND fh.activa = 1
                     ORDER BY fh.orden ASC, fh.id ASC
                     LIMIT 1)         AS fotografia
            FROM reservas r
            JOIN habitaciones h ON r.habitacion_id = h.id
           WHERE r.usuario_id = ?
           ORDER BY r.fecha_reserva DESC";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $reservas = [];
    while ($row = $result->fetch_assoc()) {
        // Determinar si la reserva ya finalizó (1 = activa, 0 = finalizada) si "estado" se usa diferente ajustarlo aquí
        $row["finalizada"] = ($row["estado"] == 0 || strtotime($row["fecha_salida"]) < time());
        $reservas[] = $row;
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($reservas);

    $stmt->close();
    $con->close();
}
?>
<?php
session_start();
include("verificarsesion.php");
include("verificarnivel.php");
include("conexion.php");

    $sql = "SELECT 
                p.id as pago_id,
                p.monto,
                p.metodo_pago,
                p.estado as estado_pago,
                p.fecha_pago,
                p.referencia,
                u.nombre_completo as cliente,
                h.numero as numero_habitacion,
                s.nombre as sucursal
            FROM pagos p
            LEFT JOIN reservas r ON p.reserva_id = r.id
            LEFT JOIN usuarios u ON r.usuario_id = u.id
            LEFT JOIN habitaciones h ON r.habitacion_id = h.id
            LEFT JOIN sucursales s ON h.sucursal_id = s.id
            ORDER BY p.fecha_pago DESC";

    $resultado = $con->query($sql);

    if (!$resultado) {
        throw new Exception("Error en la consulta: " . $con->error);
    }

    $pagos = [];
    while($pago = $resultado->fetch_assoc()) {
        $pagos[] = [
            'id' => $pago['pago_id'],
            'fecha' => $pago['fecha_pago'],
            'cliente' => $pago['cliente'],
            'habitacion' => $pago['numero_habitacion'],
            'sucursal' => $pago['sucursal'],
            'monto' => (float)$pago['monto'],
            'metodo_pago' => $pago['metodo_pago'],
            'referencia' => $pago['referencia'] ?: null,
            'estado' => (bool)$pago['estado_pago'] ? 'aprobado' : 'pendiente'
        ];
    }

    echo json_encode($pagos);

?>
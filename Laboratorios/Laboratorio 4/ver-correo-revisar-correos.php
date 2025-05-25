<?php 
session_start();
require("verificarsesion.php");
include("conexion.php");

$id = $_GET['id'];

$stmt = $con->prepare("SELECT 
    c.id,
    emisor.correo AS correo_emisor,
    emisor.nombre AS nombre_emisor,
    c.receptor AS correo_receptor,
    receptor.nombre AS nombre_receptor,
    c.asunto,
    c.mensaje,
    c.fecha,
    c.leido
FROM correos c
INNER JOIN usuarios emisor ON c.usuario_id = emisor.id
LEFT JOIN usuarios receptor ON c.receptor = receptor.correo
WHERE c.borrador = 0 
  AND c.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$correo = $result->fetch_assoc();

if ($correo) {
    ?>
    <div class="email-view">
        <div class="email-title">
            <h4><?php echo htmlspecialchars($correo['asunto']); ?></h4>
        </div>
        <div class="email-header">
            <div class="email-field">
                <span class="label">De:</span>
                <span class="value"><?php echo htmlspecialchars($correo['nombre_emisor']); ?> (<?php echo htmlspecialchars($correo['correo_emisor']); ?>)</span>
            </div>
            <div class="email-field">
                <span class="label">Para:</span>
                <span class="value"><?php echo htmlspecialchars($correo['nombre_receptor']); ?> (<?php echo htmlspecialchars($correo['correo_receptor']); ?>)</span>
            </div>
            <div class="email-field">
                <span class="label">Fecha:</span>
                <span class="value"><?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($correo['fecha']))); ?></span>
            </div>
        </div>
        <div class="email-body">
            <div class="mensaje">
                <?php echo nl2br(htmlspecialchars($correo['mensaje'])); ?>
            </div>
        </div>
    </div>
    <?php
} else {
    echo '<div class="error-message">Correo no encontrado</div>';
}
$stmt->close();

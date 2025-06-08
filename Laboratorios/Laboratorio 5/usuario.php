<?php
session_start();
if (!isset($_SESSION['nivel'])) {
    die("Acceso denegado.");
}

require 'conexion.php';

$resultado = $conexion->query("SELECT correo, nombre_completo, telefono, nivel FROM usuarios WHERE activo = 1");
?>

<h2>Lista de Usuarios</h2>
<table border="1">
    <tr>
        <th>Correo</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Nivel</th>
    </tr>
    <?php while ($fila = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?= $fila['correo'] ?></td>
        <td><?= $fila['nombre_completo'] ?></td>
        <td><?= $fila['telefono'] ?></td>
        <td><?= $fila['nivel'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

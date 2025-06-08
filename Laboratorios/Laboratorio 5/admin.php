<?php
session_start();
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'Admin') {
    die("Acceso denegado.");
}

require 'conexion.php';

$resultado = $conexion->query("SELECT * FROM usuarios");
?>

<h2>Panel de Administración</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Correo</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Nivel</th>
        <th>Acciones</th>
    </tr>
    <?php while ($fila = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?= $fila['id'] ?></td>
        <td><?= $fila['correo'] ?></td>
        <td><?= $fila['nombre_completo'] ?></td>
        <td><?= $fila['telefono'] ?></td>
        <td><?= $fila['nivel'] ?></td>
        <td>
            <a href="editar_usuario.php?id=<?= $fila['id'] ?>">Editar</a> |
            <a href="eliminar_usuario.php?id=<?= $fila['id'] ?>" onclick="return confirm('¿Seguro que quieres eliminar?')">Eliminar</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

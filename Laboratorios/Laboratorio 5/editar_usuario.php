<?php
require 'conexion.php';

if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$id = $_GET['id'];
$resultado = $conexion->query("SELECT * FROM usuarios WHERE id = $id");
$usuario = $resultado->fetch_assoc();

if (!$usuario) {
    die("Usuario no encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre_completo'];
    $telefono = $_POST['telefono'];
    $nivel = $_POST['nivel'];

    $conexion->query("UPDATE usuarios SET nombre_completo='$nombre', telefono='$telefono', nivel='$nivel' WHERE id=$id");

    header("Location: admin.php");
    exit();
}
?>

<h2>Editar Usuario</h2>
<form method="post">
    Nombre completo: <input type="text" name="nombre_completo" value="<?= $usuario['nombre_completo'] ?>"><br>
    Teléfono: <input type="text" name="telefono" value="<?= $usuario['telefono'] ?>"><br>
    Nivel: 
    <select name="nivel">
        <option value="Admin" <?= $usuario['nivel'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
        <option value="Cliente" <?= $usuario['nivel'] == 'Cliente' ? 'selected' : '' ?>>Cliente</option>
    </select><br>
    <button type="submit">Guardar</button>
    <a href="admin.php">Cancelar</a>
</form>

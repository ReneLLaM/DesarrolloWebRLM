<?php
session_start();
require("verificarsesion.php");
include("conexion.php");
require_once("verificarnivel.php");
$id = $_GET['id'];

$stmt = $con->prepare('SELECT correo, nombre, nivel from usuarios 
WHERE id = ?');
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();



?>

<form class="email-form" action="javaScript:guardarEditarCuenta();" method="post">
    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" placeholder="destinatario@empresa.com" value="<?php echo $data['correo']; ?>" required> 

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" placeholder="Contraseña">

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Asunto del correo" value="<?php echo $data['nombre']; ?>" required>

    <label for="nivel">Nivel:</label>
    <select name="nivel" id="nivel">
        <option value="1" <?php echo $data['nivel'] == 1 ? 'selected' : ''; ?>>Admin</option>
        <option value="0" <?php echo $data['nivel'] == 0 ? 'selected' : ''; ?>>Usuario</option>
    </select>

    <div class="botones">
        <button type="submit" class="btn-enviar-correo">Guardar</button>
    </div>
    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
</form>
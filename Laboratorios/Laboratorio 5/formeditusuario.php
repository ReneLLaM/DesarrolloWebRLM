<?php session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");

$id = $_GET['id'];
$stmt = $con->prepare("SELECT id,nombre_completo,correo,nivel,activo,telefono FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    ?>
    <form id="form-edit-usuario" action="javascript:editUsuario(<?php echo $row['id']; ?>)" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <label for="nombre_completo">Nombre Completo:</label>
        <input type="text" name="nombre_completo" value="<?php echo $row['nombre_completo']; ?>">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" value="<?php echo $row['correo']; ?>">
        <label for="password">Password:</label>
        <input type="password" name="password">
        <label for="telefono">Telefono:</label>
        <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>">
        <label for="nivel">Nivel:</label>
        <select name="nivel">
            <option value="0" <?php if ($row['nivel'] == 0) echo 'selected'; ?>>Usuario</option>
            <option value="1" <?php if ($row['nivel'] == 1) echo 'selected'; ?>>Administrador</option>
        </select>
        <label for="activo">Activo:</label>
        <select name="activo">
            <option value="0" <?php if ($row['activo'] == 0) echo 'selected'; ?>>Inactivo</option>
            <option value="1" <?php if ($row['activo'] == 1) echo 'selected'; ?>>Activo</option>
        </select>
        <input type="submit" value="Guardar">
    </form>
    <?php
} else {
    echo "Error datos de autenticación incorrectos";
    ?>
    <meta http-equiv="refresh" content="3;url=formlogin.html">
    <?php
}
?>
<?php session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");

$id = $_GET['id'];
$stmt = $con->prepare("SELECT id,nombre,direccion,ciudad,telefono,email,activo FROM sucursales WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    ?>
    <form action="javascript:editSucursal(<?php echo $row['id']; ?>)" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>">
        <label for="direccion">Direccion:</label>
        <input type="text" name="direccion" value="<?php echo $row['direccion']; ?>">
        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" value="<?php echo $row['ciudad']; ?>">
        <label for="telefono">Telefono:</label>
        <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>">
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $row['email']; ?>">
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
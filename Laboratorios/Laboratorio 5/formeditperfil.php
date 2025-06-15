<?php session_start();
include("conexion.php");
/* include("verificarsesion.php");
include("verificarnivel.php"); */

$id = $_GET['id'];
$stmt = $con->prepare("SELECT id,nombre_completo,correo,telefono FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    ?>
    <form action="javascript:editPerfil(<?php echo $row['id']; ?>)" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <label for="nombre_completo">Nombre Completo:</label>
        <input type="text" name="nombre_completo" value="<?php echo $row['nombre_completo']; ?>">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" value="<?php echo $row['correo']; ?>">
        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Nueva contraseña">
        <label for="telefono">Telefono:</label>
        <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>">

        <input type="submit" value="Editar">
    </form>
    <?php
} else {
    echo "Error datos de autenticación incorrectos";
    ?>
    <meta http-equiv="refresh" content="3;url=formlogin.html">
    <?php
}
?>
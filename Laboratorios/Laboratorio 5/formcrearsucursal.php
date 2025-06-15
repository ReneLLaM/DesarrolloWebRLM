<?php session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");
?>
<form action="javascript:crearSucursal()" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre">
    <label for="direccion">Direccion:</label>
    <input type="text" name="direccion">
    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad">
    <label for="telefono">Telefono:</label>
    <input type="text" name="telefono">
    <label for="email">Email:</label>
    <input type="text" name="email">
    <label for="activo">Activo:</label>
    <select name="activo">
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>
    </select>
    <input type="submit" value="Guardar">
</form>
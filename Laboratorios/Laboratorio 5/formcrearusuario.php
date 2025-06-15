<?php session_start();
include("conexion.php");
include("verificarsesion.php");
include("verificarnivel.php");
?>
<form id="form-crear-usuario" action="javascript:crearUsuario()" method="post">
    <label for="nombre_completo">Nombre Completo:</label>
    <input type="text" name="nombre_completo">
    <label for="correo">Correo:</label>
    <input type="email" name="correo">
    <label for="password">Password:</label>
    <input type="password" name="password">
    <label for="telefono">Telefono:</label>
    <input type="text" name="telefono">
    <label for="nivel">Nivel:</label>
    <select name="nivel">
        <option value="0">Usuario</option>
        <option value="1">Administrador</option>
    </select>
    <label for="activo">Activo:</label>
    <select name="activo">
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>
    </select>
    <input type="submit" value="Guardar">
</form>
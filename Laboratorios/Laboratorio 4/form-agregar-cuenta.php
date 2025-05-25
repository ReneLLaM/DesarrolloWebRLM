<?php 
session_start();
require("verificarsesion.php");
require_once("verificarnivel.php");
?>

<form class="email-form" action="javaScript:guardarAgregarCuenta();" method="post">
    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" placeholder="destinatario@empresa.com" required> 

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" placeholder="Contraseña" required>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Asunto del correo" required>

    <label for="nivel">Nivel:</label>
    <select name="nivel" id="nivel">
        <option value="1">Admin</option>
        <option value="0">Usuario</option>
    </select>

    <div class="botones">
        <button type="submit" class="btn-enviar-correo">Guardar</button>
    </div>
</form>
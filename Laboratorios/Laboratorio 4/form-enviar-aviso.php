<?php 
session_start();
require("verificarsesion.php");
require("verificarnivel.php");
?>

<form action="javaScript:guardarEnviarAviso();" method="post" class="email-form">

    <label for="asunto">Asunto:</label>
    <input type="text" name="asunto" id="asunto" required placeholder="Asunto del correo">
    <label for="mensaje">Mensaje:</label>
    <textarea name="mensaje" id="mensaje" required placeholder="Mensaje del correo"></textarea>
    <button type="submit" class="btn-enviar-correo" style="display: flex; justify-content: center;">Enviar</button>

</form>
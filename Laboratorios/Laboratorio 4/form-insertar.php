<?php
session_start();
require("verificarsesion.php");
?>

<form class="email-form" action="javaScript:enviarCorreoInsertar();" method="post">
    <label for="para">Para:</label>
    <input type="email" id="para" name="para" placeholder="destinatario@empresa.com" required> 

    <label for="asunto">Asunto:</label>
    <input type="text" id="asunto" name="asunto" placeholder="Asunto del correo" required>

    <label for="mensaje">Mensaje:</label>
    <textarea id="mensaje" name="mensaje" placeholder="Escribe tu mensaje aquí..." required></textarea>
    
    <div class="botones">
        <button onclick="guardarBorradorInsertar()" type="button" class="btn-enviar">Guardar<br>Borrador</button>
        <button  class="btn-enviar-correo">Enviar Correo</button>
    </div>
</form>
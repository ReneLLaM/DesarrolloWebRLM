<?php
session_start();
require("verificarsesion.php");
include("conexion.php");
$id = $_GET['id'];

$stmt = $con->prepare('SELECT receptor, asunto, mensaje from correos 
WHERE id = ?');
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();



?>

<form class="email-form" action="javaScript:enviarCorreoBorrador();" method="post">
    <label for="para">Para:</label>
    <input type="email" id="para" name="para" placeholder="destinatario@empresa.com" value="<?php echo $data['receptor']; ?>" required> 

    <label for="asunto">Asunto:</label>
    <input type="text" id="asunto" name="asunto" placeholder="Asunto del correo" value="<?php echo $data['asunto']; ?>" required>

    <label for="mensaje">Mensaje:</label>
    <textarea id="mensaje" name="mensaje" placeholder="Escribe tu mensaje aquí..." required><?php echo $data['mensaje']; ?></textarea>
    
    <div class="botones">
        <button onclick="guardarBorrador()" type="button" class="btn-enviar">Guardar<br>Borrador</button>
        <button  class="btn-enviar-correo">Enviar Correo</button>
    </div>
    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
</form>
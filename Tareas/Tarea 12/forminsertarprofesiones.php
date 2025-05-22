<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    session_start();
    require("verificarsesion.php");
    require("verificarnivel.php");
    ?>
    <form onsubmit="return enviarFormularioProfesion(this, 'createprofesiones.php')">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>
        </div>
        <div class="form-buttons">
            <button type="submit" class="btn-guardar">Guardar</button>
            <button type="button" onclick="modal.style.display='none'" class="btn-cancelar">Cancelar</button>
        </div>
    </form>
    
</body>
</html>
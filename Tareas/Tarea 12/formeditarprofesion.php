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
    include("conexion.php");

    $id = $_GET['id'];
    $sql = "SELECT * FROM profesiones WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_assoc();
    ?>
    <form onsubmit="return enviarFormularioProfesion(this, 'editprofesiones.php')">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required>
        </div>
        <div class="form-buttons">
            <button type="submit" class="btn-guardar">Guardar</button>
            <button type="button" onclick="modal.style.display='none'" class="btn-cancelar">Cancelar</button>
        </div>
    </form>
    
</body>
</html>
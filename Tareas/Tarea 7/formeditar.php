<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/form.css">
</head>
<body>
    <?php 
    include("conexion.php");
    $id = $_GET["id"];
    $sql = "SELECT id, nombres, apellidos, correo FROM usuarios WHERE id = $id";
    $resultado = $con->query($sql);
    $row = $resultado->fetch_assoc();

    ?>
    <div class="contenedor">
        <p>Nombres y Apellidos: <b><?php echo $row["nombres"] . " " . $row["apellidos"]; ?></b></p>
    <form action="editarusuarios.php" method="post">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" value="<?php echo $row['correo']; ?>">
        <br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" value="Actualizar">
    </form>
    </div>
</body>
</html>
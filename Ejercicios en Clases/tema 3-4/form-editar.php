<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include("conexion.php");
    $id = $_GET['id'];
    $sql = "SELECT * FROM personas WHERE id = $id";
    $resultado = $con->query($sql);
    $persona = $resultado->fetch_assoc();
    ?>
    <form action="create.php" method="post">
        <label for="nombres">Nombres: </label>
        <input type="text" name="nombres" value="<?php echo $persona['nombres']; ?>">
        <br>
        <label for="apellidos">Apellidos: </label>
        <input type="text" name="apellidos" value="<?php echo $persona['apellidos']; ?>">
        <br>
        <label for="fecha_nacimiento">Fecha de Nacimiento: </label>
        <input type="date" name="fecha_nacimiento" value="<?php echo $persona['fecha_nacimiento']; ?>">
        <br>
        <label for="sexo">Sexo: </label>
        <input type="radio" name="sexo" value="Femenino" <?php  $row['sexo'] == 'Femenino' ? 'checked' : '';?>>Femenino 
        <input type="radio" name="sexo" value="Masculino" <?php  $row['sexo'] == 'Masculino' ? 'checked' : '';?>>Masculino
        <br>
        <label for="correo_electronico">Email: </label>
        <input type="email" name="correo_electronico" value="<?php echo $persona['correo_electronico']; ?>">
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
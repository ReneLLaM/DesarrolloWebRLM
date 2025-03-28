<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/form.css">
</head>
<body>
    <?php session_start();
    require("verificarsesion.php");
    require("verificarnivel.php");
    include("header.php");
    ?>
    <form action="createusuarios.php"method="post">
        <label for="correo">Correo:</label>
        <input type="email" name="correo">
        <br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre">
        <br>
        <label for="contrasenia">Password:</label>
        <input type="password" name="contrasenia">
        <br>
        <label for="nivel">Nivel:</label>
        <input type="number" name="nivel">
        <br>
        <input type="submit" value="Guardar">

    </form>
    
</body>
</html>
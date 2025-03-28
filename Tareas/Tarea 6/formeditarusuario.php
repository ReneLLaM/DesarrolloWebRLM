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
    include("conexion.php"); 
    require("verificarsesion.php");
    require("verificarnivel.php");
    include("header.php");
    $id=$_GET['id'];
    $sql="SELECT id,correo,nombre,nivel FROM usuarios WHERE id=$id";
    $resultado=$con->query($sql);
    $row = $resultado->fetch_assoc();
    ?>
    <form action="editusuarios.php"method="post">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" value="<?php echo $row['correo'];?>">
        <br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $row['nombre'];?>">
        <br>
        <label for="contrasenia-anterior">Contraseña anterior:</label> 
        <input type="password" name="contrasenia-anterior" >
        <br>
        <label for="contrasenia">Nueva contraseña:</label>
        <input type="password" name="contrasenia" >
        <br>
        <label for="nivel">Nivel:</label>
        <input type="number" name="nivel" value="<?php echo $row['nivel'];?>">
        <br>
        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        <input type="submit" value="Guardar">

    </form>
    
</body>
</html>
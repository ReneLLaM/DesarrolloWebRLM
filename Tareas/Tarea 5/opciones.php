<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opciones</title>
</head>
<body>
    <?php session_start();?>
    <ul>
        <li><a href="insertarfrm.php?op=insertar">Insertar</a></li> 
        <li><a href="operaciones.php?op=eliminar">Eliminar</a></li>
        <li><a href="operaciones.php?op=mostrar">Mostrar</a></li>
        <li><a href="operaciones.php?op=salir">Salir</a></li>
    </ul>
</body>
</html>
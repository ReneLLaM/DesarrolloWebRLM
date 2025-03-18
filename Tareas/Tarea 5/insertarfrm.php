<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario insertar</title>

</head>
<body>

    <?php 
    session_start();
    $op = $_GET['op'];
    $_SESSION['op'] = $op;


    ?>

    <form action="operaciones.php" method="post">
        <label for="elemento">elemento: </label>
        <input type="text" name="elemento">
        <br>
        <input type="submit" value="enviar">

    </form>
</body>
</html>
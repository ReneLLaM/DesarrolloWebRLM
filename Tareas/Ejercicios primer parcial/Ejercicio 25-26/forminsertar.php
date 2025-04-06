<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php session_start();
    require("verificarsesion.php");
    require("verificarnivel.php");
    include("conexion.php");

    // $sql = "SELECT id,nombre from profesiones order by nombre";
    // $result = mysqli_query($con, $sql);

    ?>
    <form action="create.php"method="post" enctype="multipart/form-data">
        
        <label for="producto">Producto:</label>
        <input type="text" name="producto">
        <br>
        <label for="precio">Precio:</label>
        <input type="number" name="precio">
        <br>
        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" >
        <br>
        <input type="submit" value="Guardar">

    </form>
    
</body>
</html>
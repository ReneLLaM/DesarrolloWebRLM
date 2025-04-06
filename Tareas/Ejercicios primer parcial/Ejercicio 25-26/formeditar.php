<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php session_start();
    include("conexion.php");
    require("verificarsesion.php");
    require("verificarnivel.php");

    $idproducto = $_GET['idproducto'];
    $sql = "SELECT idproducto, producto, precio, imagen FROM producto WHERE idproducto=$idproducto";
    // echo $sql;
    $resultado = $con->query($sql);
    $row = $resultado->fetch_assoc();

    // $sql = "SELECT id,nombre from profesiones order by nombre";
    // $result = mysqli_query($con, $sql);
    ?>
    <form action="edit.php" method="post" enctype="multipart/form-data">
        <label for="producto">Producto:</label>
        <input type="text" name="producto" value="<?php echo $row['producto']; ?>">
        <br>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" value="<?php echo $row['precio']; ?>">
        <br>

        <?php if ($row["imagen"] != "") {
            ?> <img src="images/<?php echo $row["imagen"]; ?>" width="100px" alt="">

        <?php } ?>

        <br>
        <label for="imagen">imagen</label>
        <input type="file" name="imagen">
        <br>
        
        <input type="hidden" name="idproducto" value="<?php echo $row['idproducto']; ?>">
        <input type="submit" value="Guardar">

    </form>

</body>

</html>
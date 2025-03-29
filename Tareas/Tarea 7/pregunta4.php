<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenar Usuarios</title>

    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenar Usuarios</title>
    <link rel="stylesheet" href="styles/tabla.css">

</head>
<body>

    <?php
    include("conexion.php");

    $columna = $_GET["columna"] ?? 'nombres';
    $orden = $_GET["orden"] ?? 'ASC';

    $nuevoOrden = ($orden === 'ASC') ? 'DESC' : 'ASC';

    $columnasValidas = ['nombres', 'apellidos', 'correo'];
  
    $sql = "SELECT id, nombres, apellidos, correo FROM usuarios ORDER BY $columna $orden";
    $resultado = $con->query($sql);

    if (!$resultado) {
        die("Error en la consulta: " . $con->error);
    }

    $rows = $resultado->fetch_all(MYSQLI_ASSOC);
    ?>

    <table border="1">
        <tr>
            <th><a href="?columna=nombres&orden=<?php echo $nuevoOrden; ?>">Nombres</a></th>
            <th><a href="?columna=apellidos&orden=<?php echo $nuevoOrden; ?>">Apellidos</a></th>
            <th><a href="?columna=correo&orden=<?php echo $nuevoOrden; ?>">Correo</a></th>
        </tr>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row["nombres"]); ?></td>
                <td><?php echo htmlspecialchars($row["apellidos"]); ?></td>
                <td><a href="formeditar.php?id=<?php echo $row["id"]; ?>"><?php echo htmlspecialchars($row["correo"]); ?></a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>

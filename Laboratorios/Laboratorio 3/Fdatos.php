<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fdatos</title>
    <link rel="stylesheet" href="styles/Fdatos.css">
</head>

<body>
    <?php
    include("conexion.php");
    $sql = "SELECT codigo, carrera FROM carreras";
    $resultado = mysqli_query($con, $sql);
    $numero = $_POST['numero'];
    ?>
    <section class="formulario">

        <table style="border-collapse: collapse">

            <form action="create.php" method="post" enctype="multipart/form-data">
                <tr>
                    <th></th>
                    <th>Fotografia</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>CU</th>
                    <th>Sexo</th>
                    <th>Carrera</th>
                </tr>

                <?php for ($i = 1; $i <= $numero; $i++) { ?>
                    <tr>
                        <td class="numeracion"><label for="n<?php echo $i; ?>"> <?php echo $i; ?></label></td>
                        <td><label for="fotografia<?php echo $i; ?>" class="fotografia">Subir archivo</label>
                            <input type="file" id="fotografia<?php echo $i; ?>" name="fotografia<?php echo $i; ?>">
                        </td>
                        <td><input type="text" name="nombre<?php echo $i; ?>"></td>
                        <td><input type="text" name="apellido<?php echo $i; ?>"></td>
                        <td><input type="text" name="CU<?php echo $i; ?>"></td>

                        <td><input type="radio" name="sexo<?php echo $i; ?>" value="M"> Masculino
                            <input type="radio" name="sexo<?php echo $i; ?>" value="F"> Femenino
                        </td>

                        <td><select name="carrera<?php echo $i; ?>">
                                <?php
                                mysqli_data_seek($resultado, 0);
                                while ($row = $resultado->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['codigo']; ?>"><?php echo $row['carrera']; ?></option>
                                <?php } ?>
                            </select></td>

                    </tr>
                <?php } ?>
        </table>
        <input type="submit" value="Insertar">
        <input type="reset" value="Borrar">
        <input type="hidden" name="numero" value="<?php echo $numero; ?>">
        </form>

    </section>
</body>

</html>
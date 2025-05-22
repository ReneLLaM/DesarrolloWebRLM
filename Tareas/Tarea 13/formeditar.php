<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Persona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php session_start();
    include("conexion.php");
    require("verificarsesion.php");
    require("verificarnivel.php");
    $id = $_GET['id'];
    $sql = "SELECT id,fotografia,nombres,apellidos,fecha_nacimiento,sexo,correo,profesion_id FROM personas WHERE id=$id";
    $resultado = $con->query($sql);
    $row = $resultado->fetch_assoc();

    $sql = "SELECT id,nombre from profesiones order by nombre";
    $result = mysqli_query($con, $sql);
    ?>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white py-2">
                        <h5 class="card-title mb-0 text-center">Editar Persona</h5>
                    </div>
                    <div class="card-body py-2 px-3">
                        <form action="javascript:guardarEditar()" id="form-edit" method="post" enctype="multipart/form-data">
                            <div class="mb-2">
                                <?php if ($row["fotografia"] != "") { ?>
                                    <img src="images/<?php echo $row["fotografia"]; ?>" class="mb-2" width="100px" alt="">
                                <?php } ?>
                                <label for="fotografia" class="form-label small mb-1">Fotografía</label>
                                <input type="file" class="form-control form-control-sm" name="fotografia" id="fotografia">
                            </div>

                            <div class="mb-2">
                                <label for="nombres" class="form-label small mb-1">Nombres</label>
                                <input type="text" class="form-control form-control-sm" name="nombres" id="nombres" value="<?php echo $row['nombres']; ?>" required>
                            </div>

                            <div class="mb-2">
                                <label for="apellidos" class="form-label small mb-1">Apellidos</label>
                                <input type="text" class="form-control form-control-sm" name="apellidos" id="apellidos" value="<?php echo $row['apellidos']; ?>" required>
                            </div>

                            <div class="mb-2">
                                <label for="fecha_nacimiento" class="form-label small mb-1">Fecha de Nacimiento</label>
                                <input type="date" class="form-control form-control-sm" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $row['fecha_nacimiento']; ?>" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Sexo</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo" value="Masculino" id="masculino" <?php echo $row['sexo'] == 'Masculino' ? 'checked' : ''; ?> required>
                                        <label class="form-check-label small" for="masculino">Masculino</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo" value="Femenino" id="femenino" <?php echo $row['sexo'] == 'Femenino' ? 'checked' : ''; ?>>
                                        <label class="form-check-label small" for="femenino">Femenino</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="correo" class="form-label small mb-1">Correo</label>
                                <input type="email" class="form-control form-control-sm" name="correo" id="correo" value="<?php echo $row['correo']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="profesion_id" class="form-label small mb-1">Profesión</label>
                                <select class="form-select form-select-sm" name="profesion_id" id="profesion_id" required>
                                    <?php while ($row2 = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php echo $row2['id']; ?>" <?php echo $row['profesion_id'] == $row2['id'] ? "selected" : ""; ?>>
                                            <?php echo $row2['nombre']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-sm px-4">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
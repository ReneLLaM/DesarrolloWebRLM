<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php session_start();
    require("verificarsesion.php");
    require("verificarnivel.php");
    include("conexion.php");
    $sql = "SELECT id,nombre from profesiones order by nombre";
    $result = mysqli_query($con, $sql);
    ?>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white py-2">
                        <h5 class="card-title mb-0 text-center">Registro de Persona</h5>
                    </div>
                    <div class="card-body py-2 px-3">
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-2">
                                <label for="fotografia" class="form-label small mb-1">Fotografía</label>
                                <input type="file" class="form-control form-control-sm" name="fotografia" id="fotografia">
                            </div>

                            <div class="mb-2">
                                <label for="nombres" class="form-label small mb-1">Nombres</label>
                                <input type="text" class="form-control form-control-sm" name="nombres" id="nombres" required>
                            </div>

                            <div class="mb-2">
                                <label for="apellidos" class="form-label small mb-1">Apellidos</label>
                                <input type="text" class="form-control form-control-sm" name="apellidos" id="apellidos" required>
                            </div>

                            <div class="mb-2">
                                <label for="fecha_nacimiento" class="form-label small mb-1">Fecha de Nacimiento</label>
                                <input type="date" class="form-control form-control-sm" name="fecha_nacimiento" id="fecha_nacimiento" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Sexo</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo" value="Masculino" id="masculino" required>
                                        <label class="form-check-label small" for="masculino">Masculino</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo" value="Femenino" id="femenino">
                                        <label class="form-check-label small" for="femenino">Femenino</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="correo" class="form-label small mb-1">Correo</label>
                                <input type="email" class="form-control form-control-sm" name="correo" id="correo" required>
                            </div>

                            <div class="mb-3">
                                <label for="profesion_id" class="form-label small mb-1">Profesión</label>
                                <select class="form-select form-select-sm" name="profesion_id" id="profesion_id" required>
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

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
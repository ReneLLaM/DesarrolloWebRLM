<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Profesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php 
    session_start();
    require("verificarsesion.php");
    require("verificarnivel.php");
    ?>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white py-2">
                        <h5 class="card-title mb-0 text-center">Registro de Profesión</h5>
                    </div>
                    <div class="card-body py-2 px-3">
                        <form onsubmit="return enviarFormularioProfesion(this, 'createprofesiones.php')">
                            <div class="mb-3">
                                <label for="nombre" class="form-label small mb-1">Nombre:</label>
                                <input type="text" class="form-control form-control-sm" name="nombre" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-sm px-4">Guardar</button>
                                <button type="button" onclick="modal.style.display='none'" class="btn btn-secondary btn-sm px-4">Cancelar</button>
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
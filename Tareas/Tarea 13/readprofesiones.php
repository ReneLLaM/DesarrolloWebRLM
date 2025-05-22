<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Profesiones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <?php session_start();
        require("verificarsesion.php");
        ?>
        <div class="d-flex justify-content-end mb-3">
            <a href="cerrar.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>

        <?php
        include("conexion.php");
        $sql="SELECT id,nombre FROM profesiones";
        $resultado=$con->query($sql);
        ?>

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Lista de Profesiones</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombres</th>
                                <?php if($_SESSION['nivel']==1){ ?>
                                <th>Acciones</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row=mysqli_fetch_array($resultado)){ ?>
                            <tr>
                                <td><?php echo $row['nombre'];?></td>
                                <?php if($_SESSION['nivel']==1){ ?>
                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="editarProfesion(<?php echo $row['id'];?>)">Editar</button>
                                    <button class="btn btn-danger btn-sm" onclick="eliminarProfesion(<?php echo $row['id'];?>)">Eliminar</button>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php if($_SESSION['nivel']==1){ ?>
                <div class="mt-3">
                    <button class="btn btn-success" onclick="formInsertarProfesion()">Insertar Nueva Profesión</button>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
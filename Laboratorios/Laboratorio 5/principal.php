<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel-Sucre</title>

    <link rel="stylesheet" href="styles/principal.css">
    <link rel="stylesheet" href="styles/habitacion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="styles/agregarhabitacion.css">
</head>

<body onload="javascript:readHabitaciones()">
    <header class="header">
        <a href="javascript:readHabitaciones()" class="logo">
            <img src="iconos/hotel.png" alt="Logo">
            Hotel-Sucre
        </a>
        <div class="user-menu">
            <?php session_start();

            if (isset($_SESSION['nombre'])) { ?>
                <div class="user-info">
                    <?php if(isset($_SESSION['nivel'])){ ?><div class="reservas-user" onclick="javascript:readReservasUser(<?php echo $_SESSION['id']; ?>)">Reservas</div><?php } ?>
                    <img onclick="javascript:formEditPerfil(<?php echo $_SESSION['id']; ?>)" src="iconos/user.png" alt="Usuario">
                    <span onclick="javascript:formEditPerfil(<?php echo $_SESSION['id']; ?>)" id="nombresuario" class="nombre-usuario"><?php echo $_SESSION['nombre']; ?></span>
                    <?php if ($_SESSION['nivel'] == 1) { ?><span id="tipo-usuario">Admin</span><?php } ?>
                </div>
                <a class="btn-salir" href="cerrar.php">
                    <img src="iconos/logout.png" alt="Salir">
                    Salir
                </a>
            <?php } else { ?>
                <a class="btn-salir" href="formlogin.html">
                    <img src="iconos/login.png" alt="Login">
                    Login
                </a>
                <a href="formcrearusuariocliente.php">
                    <img src="iconos/crear-cuenta.png" alt="Crear cuenta">
                    Crear cuenta
                </a>
            <?php } ?>
        </div>
    </header>



    <div class="container">
        <?php
        if (isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1) { ?>
            <nav class="menu">
                <ul>
                    <li><a href="javascript:readUsuarios()"><img src="iconos/usuarios.png"> Usuarios</a></li>
                    <li><a href="javascript:cargarTablaHabitacionAdmin()"><img src="iconos/habitaciones.png"> Habitaciones</a></li>
                    <li><a href="javascript:readTipoHabitacionAdmin()"><img src="iconos/tipo_habitacion.png"> Tipo de habitación</a></li>
                    <li><a href="javascript:readReservas()"><img src="iconos/reservas.png"> Reservas</a></li>
                    <li><a href="javascript:readPagos()"><img src="iconos/pagos.png"> Pagos</a></li>
                    <li><a href="javascript:readSucursales()"><img src="iconos/sucursales.png"> Sucursales</a></li>
                </ul>
            </nav>
        <?php } ?>

        <div id="contenido"<?php if(!isset($_SESSION['nivel']) || $_SESSION['nivel'] == 0){ ?> style="width: 100%;" <?php } ?>>
           

        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="titulo-modal">Título del Modal</h2>
            <div id="contenido-modal">

            </div>
        </div>
    </div>


    <script src="scriptusuarios.js"></script>
    <script src="scriptsucursales.js"></script>
    <script src="scripthabitacion.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <script src="scripthabitacionadmin.js"></script>
</body>

</html>
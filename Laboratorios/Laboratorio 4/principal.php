<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correos</title>
    <link rel="stylesheet" href="styles/principal.css">
    <link rel="stylesheet" href="styles/tablas.css">
</head>

<body onload="listarBandejaEntrada()">
    <?php session_start();
    require("verificarsesion.php");
    ?>

    <header class="header">
        <div class="logo">
            <img src="iconos/email.png" alt="Logo"> Correo
        </div>
        <div class="user-menu">
            <div class="user-info">
                <img src="iconos/user.png" alt="Usuario">
                <span id="nombresuario" class="nombre-usuario"><?php echo $_SESSION['nombre']; ?></span>
                <span id="tipo-usuario"><?php echo $_SESSION['nivel'] == 1 ? 'Admin' : 'Usuario'; ?></span>
            </div>
            <a class="btn-salir" href="cerrar.php">
                <img src="iconos/logout.png" alt="Salir">
                Salir
            </a>
        </div>
    </header>

    <main class="main">
        <nav class="nav">
            <ul>
                <li><a id="nav-redactar-correo" href="javaScript:redactarCorreo()"> <svg class="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#10b981" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg>Redactar Correo</a> </li>
                <li><a id="nav-bandeja-entrada" href="javaScript:listarBandejaEntrada()"> <img class="img" src="iconos/bandeja-de-entrada.png" alt="Bandeja de entrada">Bandeja de entrada</a> </li>
                <li><a id="nav-bandeja-salida" href="javaScript:listarBandejaSalida()"> <img class="img" src="iconos/bandeja-de-salida.png" alt="Bandeja de entrada">Bandeja de salida</a> </li>
                <li><a id="nav-borradores" href="javaScript:listarBorradores()"> <img class="img" src="iconos/borradores.png" alt="Borradores">Borradores</a> </li>

                <?php
                if ($_SESSION['nivel'] == 1) {
                ?>
                    <li><a id="nav-gestionar-cuentas" href="javaScript:listarGestionarCuentas()"> <img class="img" src="iconos/gestionar-cuentas.png" alt="Gestionar Cuentas">Gestionar Cuentas</a> </li>
                    <li><a id="nav-revisar-correos" href="javaScript:listarRevisarCorreos()"> <img class="img" src="iconos/revisar-correos.png" alt="Revisar Correos">Revisar Correos</a> </li>
                    <li><a id="nav-enviar-aviso" href="javaScript:enviarAviso()"> <img class="img" src="iconos/enviar-aviso.png" alt="Enviar Aviso">Enviar Aviso</a> </li>
                <?php
                }
                ?>



            </ul>
        </nav>
        <div id="contenido">


        </div>
    </main>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="titulo-modal"></h2>
            <div id="contenido-modal" class="contenido-modal">
            </div>
            
            <div class="de">
                <p><b>De:</b></p>
                <div>
                    <p id="emisor-modal"></p>
                    <p id="nombre-modal"></p>
                </div>
            </div>
            <p id="fecha-modal"></p>
        </div>
    </div>

    <div id="modal-eliminar" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="titulo-modal">Confirmar eliminación</h2>
            <p class="contenido-modal-eliminar">¿Está seguro que desea eliminar este correo?</p>
            <div class="botones-eliminar-modal">
                <button id="btn-confirmar-eliminar" class="btn-eliminar-modal">Aceptar</button>
                <button class="btn-cancelar-modal" onclick="cerrarModalEliminar()">Cancelar</button>
            </div>
        </div>
    </div>

    <div id="modal-editar" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="titulo-modal-editar">Editar correo</h2>
            <div id="contenido-modal-editar" class="contenido-modal">
            </div>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>

</html>
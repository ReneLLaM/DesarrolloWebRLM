<?php session_start();
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Hotel</title>
    <link rel="stylesheet" href="styles/formlogin.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Crear Cuenta</h2>
            <p>Regístrate para acceder</p>
        </div>
        
        <form class="login-form" action="javascript:crearUsuarioCliente()" method="post">
            <div class="form-group">
                <label for="nombre_completo">Nombre Completo</label>
                <input type="text" name="nombre_completo" id="nombre_completo" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico</label>
                <input type="email" name="correo" id="correo" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" required>
            </div>

            <button type="submit" class="login-button">Crear cuenta</button>
            
            <div class="register-link">
                <a href="formlogin.html">¿Ya tienes cuenta? Inicia sesión</a>
            </div>
        </form>
    </div>

    <script src="scriptusuarios.js"></script>
    <script>
        function mostrarMensaje(mensaje, tipo = 'exito') {
            const divMensaje = document.createElement('div');
            divMensaje.className = `mensaje ${tipo}`;
            divMensaje.textContent = mensaje;
            
            const contenedor = document.querySelector('.login-container');
            contenedor.insertBefore(divMensaje, contenedor.firstChild);
            
            setTimeout(() => {
                divMensaje.remove();
            }, 5000);
        }
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const boton = this.querySelector('button[type="submit"]');
            boton.disabled = true;
            boton.classList.add('loading');
            
            crearUsuarioCliente();
        });

        window.crearUsuarioCliente = function() {
            const formData = new FormData(document.querySelector('form'));
            
            fetch("crearusuariocliente.php", {
                method: "POST",
                body: formData
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.exito) {
                    mostrarMensaje('¡Usuario creado exitosamente! Redirigiendo...', 'exito');
                    // Redirigir al login después de 2 segundos
                    setTimeout(() => {
                        window.location.href = 'formlogin.html';
                    }, 2000);
                } else {
                    throw new Error(data.mensaje || 'Error al crear el usuario');
                }
            })
            .catch((error) => {
                mostrarMensaje(error.message || 'Error al procesar la solicitud', 'error');
                const boton = document.querySelector('button[type="submit"]');
                boton.disabled = false;
                boton.classList.remove('loading');
            });
        };
    </script>
</body>
</html>
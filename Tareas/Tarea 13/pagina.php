<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #212529 !important;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .nav-link:hover {
            color: #0d6efd !important;
        }
        #contenido {
            background: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        /* Estilos para tablas */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            vertical-align: middle;
            border-collapse: separate;
            border-spacing: 0;
        }
        .table thead th {
            background-color: #212529;
            color: white;
            border: none;
            padding: 12px;
            font-weight: 500;
        }
        .table tbody td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            position: relative;
        }
        .close {
            position: absolute;
            right: 10px;
            top: 5px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            color: #666;
        }
        .close:hover {
            color: #000;
        }
        /* Botones de acción */
        .btn-editar {
            background-color: #198754 !important;
            color: white !important;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 3px;
        }
        .btn-eliminar {
            background-color: #dc3545 !important;
            color: white !important;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 3px;
        }
        .btn-editar:hover, .btn-eliminar:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <!-- Navbar oscura -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:listar()">Agenda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:cargarContenido('readprofesiones.php')">Profesiones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:cargarContenido('cerrar.php')">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div id="contenido">
            <!-- El contenido dinámico se cargará aquí -->
        </div>
    </div>

    <!-- Modal original -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="titulo-modal">Título del Modal</h2>
            <div id="contenido-modal">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Asegurarse de que los botones tengan los estilos correctos
        document.addEventListener('DOMContentLoaded', function() {
            // Función para aplicar estilos a los botones
            function aplicarEstilosBoton() {
                // Botones de editar
                document.querySelectorAll('button[onclick*="editar"], a[onclick*="editar"]').forEach(function(btn) {
                    btn.classList.add('btn-editar');
                });
                
                // Botones de eliminar
                document.querySelectorAll('button[onclick*="eliminar"], button[onclick*="delete"], a[onclick*="eliminar"], a[onclick*="delete"]').forEach(function(btn) {
                    btn.classList.add('btn-eliminar');
                });
            }

            // Aplicar estilos inicialmente
            aplicarEstilosBoton();

            // Observar cambios en el contenido para aplicar estilos a nuevos botones
            const observer = new MutationObserver(function(mutations) {
                aplicarEstilosBoton();
            });

            // Observar el contenedor principal
            observer.observe(document.getElementById('contenido'), {
                childList: true,
                subtree: true
            });
        });
    </script>
    <script src="script.js"></script>
</body>
</html>
<?php 
include("conexion.php");

$texto = isset($_GET['texto']) ? $_GET['texto'] : '';
$sucursal = isset($_GET['sucursal']) ? $_GET['sucursal'] : '';
$tipohabitacion = isset($_GET['tipohabitacion']) ? $_GET['tipohabitacion'] : '';
?>
<div class="contenedor-busqueda-habitaciones">
    <div class="grupo-busqueda">
        <label for="busqueda" class="etiqueta-busqueda">Buscar habitación:</label>
        <input type="text" id="busqueda" class="campo-texto-busqueda" value="<?php echo htmlspecialchars($texto); ?>" 
               onchange="javascript:readHabitaciones(this.value, document.getElementById('sucursal').value, document.getElementById('tipohabitacion').value)">
        <button class="boton-buscar" 
                onclick="javascript:readHabitaciones(document.getElementById('busqueda').value, document.getElementById('sucursal').value, document.getElementById('tipohabitacion').value)">
            <i class="fas fa-search"></i> Buscar
        </button>
    </div>

    <div class="grupo-filtros">
        <div class="filtro">
            <label for="sucursal" class="etiqueta-filtro">Sucursal:</label>
            <select id="sucursal" class="selector-filtro" 
                    onchange="javascript:readHabitaciones(document.getElementById('busqueda').value, this.value, document.getElementById('tipohabitacion').value)">
                <option value="">Todas las sucursales</option>
                <?php 
                $stmt = $con->prepare("SELECT id, nombre FROM sucursales WHERE activo = 1");
                $stmt->execute();
                $resultado = $stmt->get_result();
                while ($row = $resultado->fetch_assoc()) {
                    $selected = ($sucursal == $row['id']) ? 'selected' : '';
                    echo "<option value=\"" . $row['id'] . "\" $selected>" . $row['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="filtro">
            <label for="tipohabitacion" class="etiqueta-filtro">Tipo de habitación:</label>
            <select id="tipohabitacion" class="selector-filtro" 
                    onchange="javascript:readHabitaciones(document.getElementById('busqueda').value, document.getElementById('sucursal').value, this.value)">
                <option value="">Todos los tipos</option>
                <?php 
                $stmt = $con->prepare("SELECT id, nombre FROM tipo_habitacion WHERE activo = 1");
                $stmt->execute();
                $resultado = $stmt->get_result();
                while ($row = $resultado->fetch_assoc()) {
                    $selected = ($tipohabitacion == $row['id']) ? 'selected' : '';
                    echo "<option value=\"" . $row['id'] . "\" $selected>" . $row['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>
    </div>
</div>
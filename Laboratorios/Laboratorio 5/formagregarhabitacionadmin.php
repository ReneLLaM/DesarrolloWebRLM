<?php
include("conexion.php");

$tips = $con->query("SELECT id, nombre FROM tipo_habitacion WHERE activo=1");
$sucs = $con->query("SELECT id, nombre FROM sucursales WHERE activo=1");
?>
<div class="create-container">
<h2>Nueva Habitación</h2>
<form id="formAgregarHabitacionAdmin" method="post" action="javascript:crearHabitacionAdmin()" enctype="multipart/form-data">
    <label>Nombre:</label>
    <input type="text" name="nombre" required><br>

    <label>Número:</label>
    <input type="text" name="numero" required><br>

    <label>Piso:</label>
    <input type="number" name="piso" required><br>

    <label>Tipo:</label>
    <select name="tipo_habitacion_id" required>
        <?php while($t = $tips->fetch_assoc()) { ?>
            <option value="<?php echo $t['id']; ?>"><?php echo $t['nombre']; ?></option>
        <?php } ?>
    </select><br>

    <label>Sucursal:</label>
    <select name="sucursal_id" required>
        <?php while($s = $sucs->fetch_assoc()) { ?>
            <option value="<?php echo $s['id']; ?>"><?php echo $s['nombre']; ?></option>
        <?php } ?>
    </select><br>

    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" required><br>

    <label>Disponible:</label>
    <select name="disponible">
        <option value="1" selected>Sí</option>
        <option value="0">No</option>
    </select><br>

    <label>Superficie:</label>
    <input type="number" step="0.01" name="superficie"><br>

    <label>Nro Camas:</label>
    <input type="number" name="nro_camas"><br>

    <label>Capacidad Máxima:</label>
    <input type="number" name="capacidad_maxima"><br>

    <label>Descripción:</label>
    <textarea name="descripcion"></textarea><br>

    <h3>Agregar fotografías <small style="font-weight:normal;color:#4a90e2;">(arrastre para ordenar)</small></h3>
    <div id="photoSection">
        <label>Nombre:</label>
        <input type="text" id="tmpNombre">
        <label>Tipo:</label>
        <input type="text" id="tmpTipo">
        <label>Archivo:</label>
        <input type="file" id="tmpArchivo" accept="image/*">
        <button type="button" onclick="addPhotoToList()">Añadir</button>
    </div>
    <br>

    <button type="submit" class="btn-primary">Crear Habitación</button>
</form>
</div>

<?php
include("conexion.php");

$id = $_GET['id'];
$sql = "SELECT id, nombre, numero, piso, tipo_habitacion_id, sucursal_id, precio, disponible, superficie, nro_camas, capacidad_maxima, descripcion FROM habitaciones WHERE id='$id'";
$res = $con->query($sql);
$hab = $res->fetch_assoc();

$tips = $con->query("SELECT id, nombre FROM tipo_habitacion WHERE activo=1");
$sucs = $con->query("SELECT id, nombre FROM sucursales WHERE activo=1");
?>
<link rel="stylesheet" href="styles/edithabitacion.css">


<div class="edit-container">
<form id="formEditarHabitacionAdmin" method="post" action="javascript:editarHabitacionAdmin()">
    <input type="hidden" name="id" value="<?php echo $hab['id']; ?>">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $hab['nombre']; ?>" required><br>
    <label>Número:</label>
    <input type="text" name="numero" value="<?php echo $hab['numero']; ?>" required><br>
    <label>Piso:</label>
    <input type="number" name="piso" value="<?php echo $hab['piso']; ?>" required><br>
    <label>Tipo:</label>
    <select name="tipo_habitacion_id" required>
        <?php
        $tips = $con->query("SELECT id, nombre FROM tipo_habitacion WHERE activo=1");
        while($t = $tips->fetch_assoc()) { ?>
            <option value="<?php echo $t['id']; ?>" <?php if($t['id']==$hab['tipo_habitacion_id']) echo "selected"; ?>>
                <?php echo $t['nombre']; ?>
            </option>
        <?php } ?>
    </select><br>
    <label>Sucursal:</label>
    <select name="sucursal_id" required>
        <?php
        $sucs = $con->query("SELECT id, nombre FROM sucursales WHERE activo=1");
        while($s = $sucs->fetch_assoc()) { ?>
            <option value="<?php echo $s['id']; ?>" <?php if($s['id']==$hab['sucursal_id']) echo "selected"; ?>>
                <?php echo $s['nombre']; ?>
            </option>
        <?php } ?>
    </select><br>
    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" value="<?php echo $hab['precio']; ?>" required><br>
    <label>Disponible:</label>
    <select name="disponible">
        <option value="1" <?php if($hab['disponible']==1) echo "selected"; ?>>Sí</option>
        <option value="0" <?php if($hab['disponible']==0) echo "selected"; ?>>No</option>
    </select><br>
    <label>Superficie:</label>
    <input type="number" step="0.01" name="superficie" value="<?php echo $hab['superficie']; ?>"><br>
    <label>Nro Camas:</label>
    <input type="number" name="nro_camas" value="<?php echo $hab['nro_camas']; ?>"><br>
    <label>Capacidad Máxima:</label>
    <input type="number" name="capacidad_maxima" value="<?php echo $hab['capacidad_maxima']; ?>"><br>
    <label>Descripción:</label>
    <textarea name="descripcion"><?php echo $hab['descripcion']; ?></textarea><br>

</form>


<?php
$fotos = $con->query("SELECT * FROM fotografias_habitacion WHERE habitacion_id='$id' AND activa=1 order by orden");
echo "<h3>Fotografías actuales<small style='font-weight:normal;color:#4a90e2;'> (arrastre para ordenar)</small></h3>";
 
while($f = $fotos->fetch_assoc()) {
    echo "<div class='photo-item'>";
    echo "<img src='images/{$f['fotografia']}' alt='{$f['nombre']}'><p>{$f['nombre']}</p>";
    echo "{$f['nombre']}<br>";
    echo "<form method='post' action='javascript:eliminarFotografiaAdmin({$id}, {$f['id']})' style='display:inline;'>
            <input type='hidden' name='id' value='{$f['id']}'>
            <input type='hidden' name='habitacion_id' value='{$id}'>
            <button type='submit'>Eliminar</button>
          </form>";
    echo "</div>";
}

?>

<h3>Agregar nuevas fotografías:</h3>
<form id="formAgregarFotografiaAdmin" method="post" action="javascript:crearFotografiaAdmin()" enctype="multipart/form-data">
    <input type="hidden" name="habitacion_id" value="<?php echo $id; ?>">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <label>Tipo:</label>
    <input type="text" name="tipo" required>
    <label>Archivo:</label>
    <input type="file" name="fotografia" required>
    <label>Orden:</label>
    <input type="number" name="orden" value="0">
    <button type="submit">Subir foto</button>
</form>

<button type="submit" form="formEditarHabitacionAdmin" class="btn-primary">Guardar Cambios</button>
</div>
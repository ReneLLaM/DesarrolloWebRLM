<?php
include("conexion.php");

if(!isset($_POST['formAgregarHabitacionAdmin'])){
    echo "Solicitud inválida";
    exit;
}

$nombre             = $con->real_escape_string($_POST['nombre'] ?? '');
$numero             = $con->real_escape_string($_POST['numero'] ?? '');
$piso               = (int)($_POST['piso'] ?? 0);
$tipo_id            = (int)($_POST['tipo_habitacion_id'] ?? 0);
$sucursal_id        = (int)($_POST['sucursal_id'] ?? 0);
$precio             = (float)($_POST['precio'] ?? 0);
$disponible         = (int)($_POST['disponible'] ?? 0);
$superficie         = (float)($_POST['superficie'] ?? 0);
$nro_camas          = (int)($_POST['nro_camas'] ?? 0);
$capacidad_maxima   = (int)($_POST['capacidad_maxima'] ?? 0);
$descripcion        = $con->real_escape_string($_POST['descripcion'] ?? '');

$sql = "INSERT INTO habitaciones (nombre, numero, piso, tipo_habitacion_id, sucursal_id, precio, disponible, superficie, nro_camas, capacidad_maxima, descripcion) VALUES ('{$nombre}', '{$numero}', {$piso}, {$tipo_id}, {$sucursal_id}, {$precio}, {$disponible}, {$superficie}, {$nro_camas}, {$capacidad_maxima}, '{$descripcion}')";

if(!$con->query($sql)){
    echo "Error al crear la habitación: " . $con->error;
    exit;
}

$habitacion_id = $con->insert_id;

if(!empty($_FILES['nuevasFotos']['name'][0])){
    $destino = 'images/';
    if(!is_dir($destino)){
        mkdir($destino, 0755, true);
    }

    foreach($_FILES['nuevasFotos']['name'] as $idx => $fileName){
        $foto_nombre = $con->real_escape_string($_POST['foto_nombres'][$idx] ?? '');
        $foto_tipo   = $con->real_escape_string($_POST['foto_tipos'][$idx] ?? '');
        $foto_orden  = (int)($_POST['foto_ordenes'][$idx] ?? $idx);

        $fileTmp  = $_FILES['nuevasFotos']['tmp_name'][$idx];
        $ext      = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $nombreSeguro = uniqid('foto_') . '.' . $ext;
        $ruta = $destino . $nombreSeguro;

        if(move_uploaded_file($fileTmp, $ruta)){
            $sqlFoto = "INSERT INTO fotografias_habitacion (habitacion_id, nombre, tipo, fotografia, orden, activa) VALUES (?,?,?,?,?,1)";
            $stmtFoto = $con->prepare($sqlFoto);
            $stmtFoto->bind_param("isssi", $habitacion_id, $foto_nombre, $foto_tipo, $nombreSeguro, $foto_orden);
            $stmtFoto->execute();
        }
    }
}

echo "<p>Habitación creada correctamente.</p>";
?>

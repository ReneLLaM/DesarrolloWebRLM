<?php
include("conexion.php");

if (isset($_POST['formEditarHabitacionAdmin'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $piso = $_POST['piso'];
    $tipo = $_POST['tipo_habitacion_id'];
    $sucursal = $_POST['sucursal_id'];
    $precio = $_POST['precio'];
    $disponible = $_POST['disponible'];
    $superficie = $_POST['superficie'];
    $nro_camas = $_POST['nro_camas'];
    $capacidad = $_POST['capacidad_maxima'];
    $descripcion = $_POST['descripcion'];

    $con->begin_transaction();

    $sql = "UPDATE habitaciones SET 
        nombre='$nombre',
        numero='$numero',
        piso='$piso',
        tipo_habitacion_id='$tipo',
        sucursal_id='$sucursal',
        precio='$precio',
        disponible='$disponible',
        superficie='$superficie',
        nro_camas='$nro_camas',
        capacidad_maxima='$capacidad',
        descripcion='$descripcion'
        WHERE id='$id'";

    if($con->query($sql)){
        if (isset($_POST['fotos_manipuladas'])) {
            $fotosArray = json_decode($_POST['fotos_manipuladas'], true);
            if ($fotosArray) {
                foreach ($fotosArray as $fotoObj) {
                    $fotoId = (int)$fotoObj['id'];
                    $toDelete = (int)$fotoObj['eliminar'];
                    $nuevoOrden = (int)$fotoObj['orden'];

                    if ($toDelete) {
                        $resF = $con->query("SELECT fotografia FROM fotografias_habitacion WHERE id='$fotoId'");
                        if ($resF && $f = $resF->fetch_assoc()) {
                            $ruta = 'images/' . $f['fotografia'];
                            if (file_exists($ruta)) unlink($ruta);
                        }
                        $con->query("DELETE FROM fotografias_habitacion WHERE id='$fotoId'");
                    } else {
                        $con->query("UPDATE fotografias_habitacion SET orden='$nuevoOrden' WHERE id='$fotoId'");
                    }
                }
            }
        }

        if (isset($_FILES['nuevasFotos'])) {
            $count = count($_FILES['nuevasFotos']['name']);
            $resOrden = $con->query("SELECT IFNULL(MAX(orden), -1) + 1 AS proximo FROM fotografias_habitacion WHERE habitacion_id='$id'");
            $currentOrden = 0;
            if ($resOrden && $o = $resOrden->fetch_assoc()) {
                $currentOrden = (int)$o['proximo'];
            }
            $upload_dir = 'images/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            for ($i = 0; $i < $count; $i++) {
                if ($_FILES['nuevasFotos']['error'][$i] === UPLOAD_ERR_OK) {
                    $tmp = $_FILES['nuevasFotos']['tmp_name'][$i];
                    $name = $_FILES['nuevasFotos']['name'][$i];
                    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                    $newName = uniqid('foto_') . '.' . $ext;
                    $dest = $upload_dir . $newName;
                    if (move_uploaded_file($tmp, $dest)) {
                        $stmt = $con->prepare("INSERT INTO fotografias_habitacion (habitacion_id, nombre, tipo, fotografia, orden, activa) VALUES (?,?,?,?,?,1)");
                        $nombreFoto = pathinfo($name, PATHINFO_FILENAME);
                        $tipoFoto = $ext;
                        $stmt->bind_param("isssi", $id, $nombreFoto, $tipoFoto, $newName, $currentOrden);
                        $stmt->execute();
                        $currentOrden++;
                    }
                }
            }
        }

        $con->commit();
        header("Location: formedithabitacionadmin.php?id=$id&msg=editok");
        exit();
    } else {
        $con->rollback();
        echo "Error al actualizar la habitación: " . $con->error;
    }
} else {
    echo "No se recibieron los datos necesarios.";
}
?>
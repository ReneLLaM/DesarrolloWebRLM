<?php
include("conexion.php");

if (isset($_POST['id'], $_POST['habitacion_id'])) {
    $foto_id = $_POST['id'];
    $habitacion_id = $_POST['habitacion_id'];

    $sql = "SELECT fotografia FROM fotografias_habitacion WHERE id='$foto_id'";
    $res = $con->query($sql);
    if ($f = $res->fetch_assoc()) {
        $ruta = 'images/' . $f['fotografia'];
        if (file_exists($ruta)) unlink($ruta);
    }
    $con->query("DELETE FROM fotografias_habitacion WHERE id='$foto_id'");
    header("Location: formedithabitacionadmin.php?id=$habitacion_id&msg=del_ok");
    exit();
} else {
    header("Location: principal.php");
    exit();
}
?>
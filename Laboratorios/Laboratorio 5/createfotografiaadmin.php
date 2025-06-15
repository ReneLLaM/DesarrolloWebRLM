<?php
include("conexion.php");

if (isset($_POST['habitacion_id'], $_POST['nombre'], $_POST['tipo'], $_FILES['fotografia'])) {
    $habitacion_id = $_POST['habitacion_id'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $orden = isset($_POST['orden']) ? (int)$_POST['orden'] : 0;

    $upload_dir = 'images/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = $_FILES['fotografia']['name'];
    $file_tmp = $_FILES['fotografia']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $new_file_name = uniqid('foto_') . '.' . $file_ext;
    $file_destination = $upload_dir . $new_file_name;

    if (move_uploaded_file($file_tmp, $file_destination)) {
        $sql = "INSERT INTO fotografias_habitacion (habitacion_id, nombre, tipo, fotografia, orden, activa) 
                VALUES (?, ?, ?, ?, ?, 1)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("isssi", $habitacion_id, $nombre, $tipo, $new_file_name, $orden);

        if ($stmt->execute()) {
            header("Location: formedithabitacionadmin.php?id=" . $habitacion_id . "&msg=success");
            exit();
        } else {
            unlink($file_destination);
            header("Location: formedithabitacionadmin.php?id=" . $habitacion_id . "&msg=dberror");
            exit();
        }
    } else {
        header("Location: formedithabitacionadmin.php?id=" . $habitacion_id . "&msg=uploaderror");
        exit();
    }
} else {
    header("Location: principal.php");
    exit();
}
?>
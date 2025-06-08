<?php
require 'conexion.php';

if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$id = $_GET['id'];
$conexion->query("DELETE FROM usuarios WHERE id = $id");

header("Location: admin.php");
exit();

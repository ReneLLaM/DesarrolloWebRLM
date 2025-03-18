<?php 
session_start();
$op = $_GET['op'];
$_SESSION['op'] = $op;
header("Location: operaciones.php");
exit();
?>
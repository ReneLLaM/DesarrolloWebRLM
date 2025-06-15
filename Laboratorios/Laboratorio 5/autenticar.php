<?php session_start();
include("conexion.php");
$correo = $_POST['correo'];
$password = sha1($_POST['password']);

$stmt = $con->prepare('SELECT id, correo,nombre_completo,nivel FROM usuarios WHERE correo=? AND password=? AND activo=1');
$stmt->bind_param("ss", $correo, $password);
$stmt->execute();

$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $_SESSION['correo'] = $correo;
    $_SESSION['nivel'] = $row['nivel'];
    $_SESSION["id"] = $row['id'];
    $_SESSION["nombre"] = $row['nombre_completo'];
    header("Location:principal.php");

} else {
    echo "Error datos de autenticación incorrectos";
    ?>
    <meta http-equiv="refresh" content="3;url=formlogin.html">
    <?php
}

?>
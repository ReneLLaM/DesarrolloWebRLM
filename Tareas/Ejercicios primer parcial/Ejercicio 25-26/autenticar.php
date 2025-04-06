<?php session_start();
include("conexion.php");

$usuario = $_POST['usuario'];
$password = sha1($_POST['password']);

$stmt = $con->prepare('SELECT usuario, nivel FROM usuario WHERE usuario=? AND password=?');
$stmt->bind_param("ss", $usuario, $password);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "Usuario encontrado";
    $_SESSION['usuario'] = $usuario;
    $_SESSION['nivel'] = $result->fetch_assoc()['nivel'];
    header("Location:read.php");

} else {
    echo "Error datos de autenticación incorrectos";
    ?>
    <meta http-equiv="refresh" content="3;url=formlogin.php">
    <?php
}

?>
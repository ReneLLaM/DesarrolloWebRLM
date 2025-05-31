<?php session_start();
include("conexion.php");
$usuario = $_POST['usuario'];
$password = sha1($_POST['password']);
$stmt = $con->prepare('SELECT id, usuario,nombrecompleto,nivel FROM usuarios WHERE usuario=? AND password=?');
$stmt->bind_param("ss", $usuario, $password);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['nivel'] = $row['nivel'];
    $_SESSION["id"] = $row['id'];
    header("Location:ejercicios2Parcial.html");

} else {
    echo "Error datos de autenticación incorrectos";
    ?>
    <meta http-equiv="refresh" content="3;url=formlogin.html">
    <?php
}

?>



<?php session_start();
include("conexion.php");
$correo = $_POST['correo'];
$password = sha1($_POST['password']);
$stmt = mysqli_prepare($con, 'SELECT correo,nombre,nivel FROM usuarios WHERE correo=? AND password=? AND estado=1');
mysqli_stmt_bind_param($stmt, "ss", $correo, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if ($result->num_rows > 0) {
    echo "Usuario encontrado";
    $row = $result->fetch_assoc();
    $_SESSION['correo'] = $correo;
    $_SESSION['nivel'] = $row['nivel'];
    $_SESSION['nombre'] = $row['nombre'];
    
    header("Location:principal.php");
} else {
    echo "Error datos de autenticación incorrectos";
    ?>
    <meta http-equiv="refresh" content="2;url=formlogin.html">
<?php
}
?>
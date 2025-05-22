<?php session_start();
include("conexion.php");
$correo = $_POST['correo'];
$password = sha1($_POST['password']);
$stmt = $con->prepare('SELECT correo,nombre,nivel FROM usuarios WHERE correo=? AND password=?');
$stmt->bind_param("ss", $correo, $password);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $_SESSION['correo'] = $correo;
    $_SESSION['nivel'] = $result->fetch_assoc()['nivel'];
    // header("Location:correos.php");
    echo json_encode($result);

} else {
   die();
}

?>
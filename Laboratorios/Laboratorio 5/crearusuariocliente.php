<?php
header('Content-Type: application/json');
session_start();
include("conexion.php");
$respuesta = [
    'exito' => false,
    'mensaje' => ''
];

try {
    $camposRequeridos = ['nombre_completo', 'correo', 'password', 'telefono'];
    $datosFaltantes = [];
    
    foreach ($camposRequeridos as $campo) {
        if (empty($_POST[$campo])) {
            $datosFaltantes[] = $campo;
        }
    }
    
    if (!empty($datosFaltantes)) {
        throw new Exception('Faltan los siguientes campos obligatorios: ' . implode(', ', $datosFaltantes));
    }
    
    $nombre_completo = trim($_POST['nombre_completo']);
    $correo = filter_var(trim($_POST['correo']), FILTER_VALIDATE_EMAIL);
    $telefono = trim($_POST['telefono']);
    
    if (!$correo) {
        throw new Exception('El formato del correo electrónico no es válido');
    }
    
    if (strlen($_POST['password']) < 6) {
        throw new Exception('La contraseña debe tener al menos 6 caracteres');
    }
    $password = sha1($_POST['password']);
    
    $stmt = $con->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        throw new Exception('El correo electrónico ya está registrado');
    }
    $stmt->close();
    
    $stmt = $con->prepare("INSERT INTO usuarios (nombre_completo, correo, password, nivel, activo, telefono) VALUES (?, ?, ?, 0, 1, ?)");
    $stmt->bind_param("ssss", $nombre_completo, $correo, $password, $telefono);
    
    if ($stmt->execute()) {
        $respuesta['exito'] = true;
        $respuesta['mensaje'] = 'Usuario registrado exitosamente';
        
        $usuario_id = $stmt->insert_id;
        $_SESSION['usuario_id'] = $usuario_id;
        $_SESSION['nombre_completo'] = $nombre_completo;
        $_SESSION['nivel'] = 0;
        
    } else {
        throw new Exception('Error al registrar el usuario: ' . $stmt->error);
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    $respuesta['mensaje'] = $e->getMessage();
}

if (isset($con)) {
    $con->close();
}
echo json_encode($respuesta);
?>
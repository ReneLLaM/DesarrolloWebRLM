<?php session_start();

require("verificarsesion.php");

include("conexion.php");

$orden = isset($_GET['orden']) ? $_GET['orden'] : "personas.id";
$asente = isset($_GET['asendente']) ? $_GET['asendente'] : "asc";
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : "";
$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;

// Validar orden para prevenir SQL injection
$ordenesPermitidos = [
    "personas.id", "nombres", "apellidos", "fecha_nacimiento", 
    "sexo", "correo", "profesion"
];
if (!in_array($orden, $ordenesPermitidos)) {
    $orden = "personas.id";
}

// Validar dirección de ordenamiento
$asente = strtolower($asente) === "desc" ? "desc" : "asc";

// Calcular total de registros y páginas
$sql2 = "SELECT COUNT(*) as total FROM personas 
         LEFT JOIN profesiones ON personas.profesion_id=profesiones.id
         WHERE nombres LIKE ? OR apellidos LIKE ? OR 
               correo LIKE ? OR profesiones.nombre LIKE ?";
$stmt = $con->prepare($sql2);
$buscarParam = "%$buscar%";
$stmt->bind_param("ssss", $buscarParam, $buscarParam, $buscarParam, $buscarParam);
$stmt->execute();
$resultado2 = $stmt->get_result();
$row2 = $resultado2->fetch_assoc();
$total = $row2['total'];
$porPagina = 10;
$nropaginas = ceil($total / $porPagina);

// Validar página actual
if ($pagina < 1) $pagina = 1;
if ($pagina > $nropaginas) $pagina = $nropaginas;
$inicio = ($pagina - 1) * $porPagina;

// Consulta principal con parámetros preparados
$sql = "SELECT personas.id, fotografia, nombres, apellidos, fecha_nacimiento, 
               sexo, correo, profesiones.nombre as profesion 
        FROM personas
        LEFT JOIN profesiones ON personas.profesion_id=profesiones.id 
        WHERE nombres LIKE ? OR apellidos LIKE ? OR 
              correo LIKE ? OR profesiones.nombre LIKE ?
        ORDER BY $orden $asente
        LIMIT ?, ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("ssssii", $buscarParam, $buscarParam, $buscarParam, $buscarParam, $inicio, $porPagina);
$stmt->execute();
$resultado = $stmt->get_result();

$arreglo = [];
while($row = $resultado->fetch_assoc()) {
    $arreglo[] = [
        "id" => $row['id'],
        "fotografia" => $row['fotografia'],
        "nombres" => $row['nombres'],
        "apellidos" => $row['apellidos'],
        "fecha_nacimiento" => $row['fecha_nacimiento'],
        "sexo" => $row['sexo'],
        "correo" => $row['correo'],
        "profesion" => $row['profesion']
    ];
}

$nuevoarreglo = [
    "datos" => $arreglo,
    "buscar" => $buscar,
    "pagina" => $pagina,
    "orden" => $orden,
    "nropaginas" => $nropaginas,
    "nivel" => $_SESSION['nivel']
];

echo json_encode($nuevoarreglo);
?>
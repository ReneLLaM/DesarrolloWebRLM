<?php 
include_once("conexion.php");

if(isset($_GET['texto'])){
    $texto = $_GET['texto'];
}else{
    $texto = "";
}

$where_conditions = [];
$params = [];
$types = '';

if(isset($_GET['sucursal']) && $_GET['sucursal'] != ""){
    $where_conditions[] = "h.sucursal_id = ?";
    $params[] = $_GET['sucursal'];
    $types .= 'i';
}
if(isset($_GET['tipohabitacion']) && $_GET['tipohabitacion'] != ""){
    $where_conditions[] = "h.tipo_habitacion_id = ?";
    $params[] = $_GET['tipohabitacion'];
    $types .= 'i';
}

$sql = "SELECT 
t.nombre AS nombretipohabitacion,
h.id,
h.nombre AS nombrehabitacion,
h.precio,
h.superficie,
h.capacidad_maxima,
SUBSTRING_INDEX(GROUP_CONCAT(f.fotografia ORDER BY f.orden ASC), ',', 1) AS fotografia
FROM habitaciones h
INNER JOIN tipo_habitacion t ON t.id = h.tipo_habitacion_id
INNER JOIN sucursales s ON s.id = h.sucursal_id
INNER JOIN fotografias_habitacion f ON f.habitacion_id = h.id
WHERE t.activo = 1 and h.disponible = 1
AND s.activo = 1";

if (!empty($where_conditions)) {
    $sql .= " AND " . implode(" AND ", $where_conditions);
}

$sql .= " GROUP BY h.id
HAVING nombrehabitacion LIKE ?
OR nombretipohabitacion LIKE ?
OR precio LIKE ?
OR superficie LIKE ?
OR capacidad_maxima LIKE ?";

$stmt = $con->prepare($sql);

$search_term = "%$texto%";
$stmt->bind_param($types . 'sssss', ...array_merge($params, [$search_term, $search_term, $search_term, $search_term, $search_term]));

$stmt->execute();
$resultado = $stmt->get_result();

$data = [];
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

?>
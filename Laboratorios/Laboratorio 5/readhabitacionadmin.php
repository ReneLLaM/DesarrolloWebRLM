<?php
include("conexion.php");
echo "<button onclick='javascript:formAgregarHabitacionAdmin()' style='margin-bottom:10px;'>Nueva Habitación</button>";

$sql = "SELECT h.id, h.nombre, h.numero, h.piso, h.precio, h.disponible, h.superficie, h.nro_camas, h.capacidad_maxima, h.descripcion,
        t.nombre AS tipo, s.nombre AS sucursal,
        (SELECT fotografia FROM fotografias_habitacion f WHERE f.habitacion_id = h.id AND f.activa=1 ORDER BY f.orden ASC LIMIT 1) AS foto_principal
        FROM habitaciones h
        LEFT JOIN tipo_habitacion t ON h.tipo_habitacion_id = t.id
        LEFT JOIN sucursales s ON h.sucursal_id = s.id
        ORDER BY h.id ASC";
$result = $con->query($sql);

echo "<table border='1' style='border-collapse:collapse; width:100%;'>";
echo "<tr>
<th>Nombre</th>
<th>Número</th>
<th>Piso</th>
<th>Tipo</th>
<th>Sucursal</th>
<th>Precio</th>
<th>Disponible</th>
<th>Superficie</th>
<th>Nro Camas</th>
<th>Capacidad</th>
<th>Descripción</th>
<th>Foto</th>
<th>Acciones</th>
</tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "
          <td>{$row['nombre']}</td>
          <td>{$row['numero']}</td>
          <td>{$row['piso']}</td>
          <td>{$row['tipo']}</td>
          <td>{$row['sucursal']}</td>
          <td>{$row['precio']}</td>
          <td>".($row['disponible'] ? "Sí" : "No")."</td>
          <td>{$row['superficie']}</td>
          <td>{$row['nro_camas']}</td>
          <td>{$row['capacidad_maxima']}</td>
          <td>{$row['descripcion']}</td>  
          <td><img src='images/".rawurlencode($row['foto_principal'])."' width='80'></td>
          <td>
            <button onclick='javascript:formEditarHabitacionAdmin({$row['id']})'>Editar</button>
            <button onclick='javascript:eliminarHabitacionAdmin({$row['id']})'>Eliminar</button>
          </td>";
echo "</tr>";
}
echo "</table>";
?>
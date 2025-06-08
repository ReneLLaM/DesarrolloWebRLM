<?php session_start();

require("verificarsesion.php");

?>

<?php
include("conexion.php");

$sql="SELECT fotografia,personas.id,nombres,apellidos,fecha_nacimiento,sexo,correo,profesiones.nombre as profesion FROM personas
      LEFT JOIN profesiones ON personas.profesion_id=profesiones.id 
      WHERE  nombres like '%$buscar%'  or apellidos like '%$buscar%' or correo like '%$buscar%' or profesiones.nombre like '%$buscar%'
      order by $orden $asente
      limit $inicio, 10  ";
$resultado=$con->query($sql);
$arreglo = [];
while($row=mysqli_fetch_array($resultado)){
    $arreglo[] = ["id" => $row['id'],
          "nombres" => $row['nombres'],
        "apellidos"=>$row["apellidos"],
        "fecha_nacimiento"=>$row["fecha_nacimiento"],
        "sexo"=>$row["sexo"],
        "correo"=>$row["correo"],
        "profesion"=>$row["profesion"],
    ];
}
echo json_encode($arreglo);





?>

    
 





 
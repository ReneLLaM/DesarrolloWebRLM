<?php session_start();
include("conexion.php");

if (!isset($_SESSION['usuario'])) { // si no existe la variable de sesion redirige a la pagina de login
    header("Location:formlogin.html");
}


$sql = "SELECT id, imagen, titulo FROM libros;";
$resultado = $con->query($sql);

$arreglo = [];
while($row=mysqli_fetch_array($resultado)){
    $arreglo[] = ["id" => $row['id'],
          "imagen" => $row['imagen'],
        "titulo"=>$row["titulo"],
    ];
}

echo json_encode($arreglo);



?>